/*
Block Options
*/
function _getBlockClass(props, prefix){
  let classStr = props.attributes.className;
  if ( typeof classStr === 'undefined' ) {
    return '';
  }
  return classStr.split(' ').find(element => element.includes(prefix));
}
function _setBlockClasses(props, prefix, value){
  let classStr = props.attributes.className;
  // no classes yet
  if ( typeof classStr === 'undefined' ) {
    return value;
  }
  // get all of the classes without this prefix
  let classArr = classStr.split(' ').filter(element => !element.includes(prefix));
  // add the new one
  classArr.push(value);
  return classArr.join(' ');
}
function _getPaddingClasses(prefix){
  return [
    { label: 'Default', value: prefix + 'default' },
    { label: 'Small', value: prefix + 'small' },
    { label: 'Medium', value: prefix + 'medium' },
    { label: 'Large', value: prefix + 'large' },
    { label: 'None', value: prefix + 'none' },
  ]
}
function _getBackgroundClasses(prefix){
  return [
    { label: 'White', value: prefix + 'default' },
    { label: 'Light Gray', value: prefix + 'light-gray' },
  ]
}

var el = wp.element.createElement;
const blocksWithCustomOptions = [
  'core/group',
  'core/columns',
  'acf/namespace-fifty-fifty',
];
 
var customBlockOptions = wp.compose.createHigherOrderComponent( function( BlockEdit ) {
  return function( props ) {
    // only add options to select blocks
    if (!blocksWithCustomOptions.includes(props.name)) {
      return el(
        wp.element.Fragment,
        {},
        el(
            BlockEdit,
            props
        ),
      );
    }
    // create the Extra Options panel
    return el(
      wp.element.Fragment,
      {},
      el( // default panel
          BlockEdit,
          props
      ),
      el( // custom panel
          wp.blockEditor.InspectorControls,
          {},
          el(
              wp.components.PanelBody,
              { title: 'Block Options', initialOpen: false },
              el(
                wp.components.SelectControl,
                {
                  label: 'Top Padding',
                  onChange: ( value ) => {
                    props.setAttributes( {
                      className: _setBlockClasses(props, 'pt-', value)
                    } )
                  },
                  value: _getBlockClass(props, 'pt-'),
                  options: _getPaddingClasses('pt-')
                }
              ),
              el(
                wp.components.SelectControl,
                {
                  label: 'Bottom Padding',
                  onChange: ( value ) => {
                    props.setAttributes( {
                      className: _setBlockClasses(props, 'pb-', value)
                    } )
                  },
                  value: _getBlockClass(props, 'pb-'),
                  options: _getPaddingClasses('pb-')
                }
              ),
              el(
                wp.components.SelectControl,
                {
                  label: 'Background Color',
                  onChange: ( value ) => {
                    props.setAttributes( {
                      className: _setBlockClasses(props, 'bg-', value)
                    } )
                  },
                  value: _getBlockClass(props, 'bg-'),
                  options: _getBackgroundClasses('bg-')
                }
              )
          )
      )
    );     
  };
}, 'customBlockOptions' );
 
wp.hooks.addFilter( 'editor.BlockEdit', 'namespace/block-padding-options', customBlockOptions );

/*
Core Block Variants
core/button
core/list
core/heading
*/
// remove core option
wp.blocks.unregisterBlockStyle( 'core/button', 'outline' );
// add core option
wp.blocks.registerBlockStyle("core/paragraph", {
  name: "lead-paragraph",
  label: "Lead Paragraph"
});

/*
Featured Image Size Note
*/
function wrapPostFeaturedImage( OriginalComponent ) { 
  return function( props ) {
    let size = ''
    let postTypes = ['post','page']
    if (postTypes.includes(props.postType.slug)) {
      size = '1200px by 400px'
    }
    return (
      el(
        wp.element.Fragment,
        {}, 
        '',
        el(
          OriginalComponent,
          props
        ),
        size
      )
    );
  } 
} 

wp.hooks.addFilter( 
  'editor.PostFeaturedImage', 
  'namespace/wrap-post-featured-image', 
  wrapPostFeaturedImage
);