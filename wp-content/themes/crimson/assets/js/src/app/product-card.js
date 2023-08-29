import { jsPDF } from "jspdf";
import 'jspdf-autotable';


jQuery(document).ready(function($) {

    if(!$('#product-search-input').length) return;

    let searchQueryInput = $('#product-search-input'),
        prodCategoryCheckboxes = $("input[name='product-filter']"),
        countryCheckboxes = $("input[name='country-filter']"),
        locationCheckboxes = $("input[name='location-filter']"),
        vendorCheckboxes = $("input[name='vendor-filter']"),
        clearAll = $('#product-seach-clear-button'),
        loadAllSuppliers = $('#loadMoreSuppliers');

    $(window).on('load', function () {
        standardProductsSearchTrigger();
    });

    searchQueryInput.on('keyup update', function () {
        clearButtonCheck();
    });
  
    loadAllSuppliers.on('click', function () {
        let hiddenSupplierCheckBoxes = $('#collapseVendorCheckboxes .checkbox.d-none');

        hiddenSupplierCheckBoxes.each(function () {
            $(this).removeClass('d-none');
        });
        loadAllSuppliers.addClass('d-none');

    });

    $('#product-search-submit-button').on('click', function () {
        standardProductsSearchTrigger();
    });
    $('#js-export').on('click', function () {
        exportProducts();
    });
    $('#product-search-input').on('keyup', function (e) {
        if (e.keyCode === 13) {
            standardProductsSearchTrigger();
        }
    });

    prodCategoryCheckboxes.on('change update', function () {
        standardProductsSearchTrigger();
    });
    locationCheckboxes.on('change update', function () {
        standardProductsSearchTrigger();
    });
    vendorCheckboxes.on('change update', function () {
        standardProductsSearchTrigger();
    });
    countryCheckboxes.on('change update', function () {
        standardProductsSearchTrigger();
    });

    function standardProductsSearchTrigger() {
        productsSearch();
        clearButtonCheck();
        countResults();
    }

    clearAll.on('click', function () {
        resetForm();
    });

    function resetForm() {

        let checkedLocations = $("input[name='location-filter']:checked");
        let checkedVendors = $("input[name='vendor-filter']:checked");
        let checkedProdCategories = $("input[name='product-filter']:checked");
        let checkedCountries = $("input[name='product-country']:checked");

        searchQueryInput.val('');
      
        checkedLocations.each(function () {
            $(this).prop('checked', false);
        });
        checkedVendors.each(function () {
            $(this).prop('checked', false);
        });
        checkedProdCategories.each(function () {
            $(this).prop('checked', false);
        });
        checkedCountries.each(function () {
            $(this).prop('checked', false);
        });

        productsSearch();
        clearButtonCheck();
        countResults();
    }

    function clearButtonCheck() {
        if(searchQueryInput.val().length ||
            $("input[name='location-filter']:checked").length ||
            $("input[name='vendor-filter']:checked").length ||
            $("input[name='product-filter']:checked").length ||
            $("input[name='country-filter']:checked").length
        ) {
            clearAll.removeClass('d-none');

        } else {
            clearAll.addClass('d-none');
        }
    }

    function countResults() {
        let resultsTotal = $('.prod-search-results .prod-search-result:not(.d-none)').length,
            resultsCounter = $('.js-results-counter');

        resultsCounter.text(resultsTotal);
    }

    function findCommonElements(arr1, arr2) {
        return arr1.some(item => arr2.includes(item))
    }

    /*
     * Export results to PDF with jsPDF
     * Documentation: https://github.com/simonbengtsson/jsPDF-AutoTable
     */ 
    function exportProducts() {
        
        const doc = new jsPDF();

        let automation = 'automation',
            robotics = 'robotics',
            compressedAir = 'compressed-air',
            head = headRows();

        function getSupplierDataByCategory(category) {
            let result = [],
                suppliersToExport = [],
                productsToExport = [],
                statesToExport = [];

            $.each($(".prod-search-result.js-" + category + ":not(.d-none) .prod-search-title"), function() {
                suppliersToExport.push($(this).text());
            });
            $.each($(".prod-search-result.js-" + category + ":not(.d-none) .products ." + category + ""), function() {
                const matchNewLines = /\r?\n|\r/g;
                productsToExport.push($(this).text().replace(matchNewLines, ''));
            });
            $.each($(".prod-search-result.js-" + category + ":not(.d-none) .prod-location"), function() {
                const r = /\B\s+|\s+\B/g;
                statesToExport.push($(this).text().replace(r, '').replace(/,/g, ', '));
            });
            for ( let i = 0; i < suppliersToExport.length; i++ ) {
                result.push( [ suppliersToExport[i], productsToExport[i], statesToExport[i] ] );
            }

            return result;
        }
        // Create Header Titles for each Row
        function headRows() {
            return [
                { 
                    supplier: 'Supplier',
                    products: 'Products',
                    states: 'States' 
                },
             ]
          }
        
        doc.autoTable({ 
            headStyles: {
                fillColor: [228, 19, 10],
                fontSize: 12,
              },
            startY: 20,
        })

        let bodyAutomation = getSupplierDataByCategory(automation),
            bodyCompressedAir = getSupplierDataByCategory(compressedAir),
            bodyRobotics = getSupplierDataByCategory(robotics),
            pageHeight = doc.internal.pageSize.getHeight(),
            pageWidth = doc.internal.pageSize.getWidth(),
            // coverPage = '/wp-content/themes/crimson/assets/images/productcard/cover.jpg',
            // aboutPage = '/wp-content/themes/crimson/assets/images/productcard/about.jpg',
            headerImage = '/wp-content/themes/crimson/assets/images/productcard/plc_header_v2.jpg',
            footerImg = '/wp-content/themes/crimson/assets/images/productcard/plc_footer.jpg',
            y = 800,
            x = 800;

        // Add Coverpage
        // if (y >= pageHeight) {
        //     doc.addImage(coverPage, 'JPEG', 0, 0, pageWidth, pageHeight);
        //     y = 0;
        // }
        // Add About page
        // if (x >= pageHeight) {
        //     doc.addPage();
        //     doc.addImage(aboutPage, 'JPEG', 0, 0, pageWidth, pageHeight);
        //     doc.addPage();
        //     x = 0;
        // }
        
        if (bodyAutomation.length !== 0) {
            doc.text('Automation', 14, 60)
            doc.autoTable({
                head: head, 
                body: bodyAutomation,
                headStyles: {
                    fillColor: [228, 19, 10],
                    fontSize: 12,
                },
                columnStyles: {
                    0: {cellWidth: 30},
                    1: {cellWidth: 110},
                    2: {cellWidth: 40},
                },
                startY: 65,
                showHead: 'firstPage',
                rowPageBreak: 'avoid',
                margin: { top: 55, bottom: 30, },
                didDrawPage: function (data) {
                    if (headerImage) {
                      doc.addImage(headerImage, 'JPEG', 0, 0, pageWidth, 50)
                    }

                var pageSize = doc.internal.pageSize
                var pageHeight = pageSize.height ? pageSize.height : pageSize.getHeight()
                doc.addImage(footerImg, 'JPEG', 0, pageHeight - 23, pageWidth, 22)
                },
            })
        }
        let finalY = doc.lastAutoTable.finalY + 20;
        if (bodyCompressedAir.length !== 0) {
            
            doc.text('Compressed Air', 14, finalY + 5)
            doc.autoTable({
                head: head, 
                body: bodyCompressedAir,
                headStyles: {
                    fillColor: [228, 19, 10],
                    fontSize: 12,
                    },
                columnStyles: {
                    0: {cellWidth: 30},
                    1: {cellWidth: 110},
                    2: {cellWidth: 40},
                },
                startY: doc.lastAutoTable.finalY + 30,
                showHead: 'firstPage',
                rowPageBreak: 'avoid',
                margin: { top: 55, bottom: 30, },
                didDrawPage: function (data) {
                    if (headerImage) {
                      doc.addImage(headerImage, 'JPEG', 0, 0, pageWidth, 50)
                    }
                    var pageSize = doc.internal.pageSize
                    var pageHeight = pageSize.height ? pageSize.height : pageSize.getHeight()
                    doc.addImage(footerImg, 'JPEG', 0, pageHeight - 23, pageWidth, 22)
                },
                
            })
        }
        let finalY2 = doc.lastAutoTable.finalY;
        if (bodyRobotics.length !== 0) {

            doc.text('Robotics', 14, finalY2 + 25)
            doc.autoTable({
                head: head, 
                body: bodyRobotics,
                headStyles: {
                    fillColor: [228, 19, 10],
                    fontSize: 12,
                    },
                columnStyles: {
                    0: {cellWidth: 30},
                    1: {cellWidth: 110},
                    2: {cellWidth: 40},
                },
                startY: doc.lastAutoTable.finalY + 30,
                showHead: 'firstPage',
                rowPageBreak: 'avoid',
                margin: { top: 55, bottom: 30, },
                didDrawPage: function (data) {
                    if (headerImage) {
                      doc.addImage(headerImage, 'JPEG', 0, 0, pageWidth, 50)
                    }
                    var pageSize = doc.internal.pageSize
                    var pageHeight = pageSize.height ? pageSize.height : pageSize.getHeight()
                    doc.addImage(footerImg, 'JPEG', 0, pageHeight - 23, pageWidth, 22)
                },
            })
        }
        
        doc.save('JHFoster-Line-Card.pdf')
        
    }

    function productsSearch() {

        let searchQuery = searchQueryInput.val(),
            locationsToFilter = [],
            productCategoriesToFilter = [],
            vendorsToFilter = [],
            countriesToFilter = [];

        $.each($("input[name='location-filter']:checked"), function(){
            locationsToFilter.push($(this).val());
        });
        $.each($("input[name='product-filter']:checked"), function(){
            productCategoriesToFilter.push($(this).val());
        });
        $.each($("input[name='vendor-filter']:checked"), function(){
            vendorsToFilter.push($(this).val());
        });
        $.each($("input[name='country-filter']:checked"), function(){
            countriesToFilter.push($(this).val());
        });

        $(window.vendors).each(function (index, element) {
            let matches = {
                title: false,
                type: false,
                location: false,
                vendor: false,
                prodCategory: false,
                country: false
            };
            let searchInputArray = searchQuery.split(' ');

            for (let s_i = 0; s_i < searchInputArray.length; s_i++) {
                // Check Title
                let title = element.title.toLowerCase();

                if (-1 !== (title.search(searchInputArray[s_i].toLowerCase()))) {
                    matches.title = true; break;
                } else {
                    matches.title = false;
                }
            }
            // Location (states) Check
            if(!locationsToFilter.length) {
                matches.location = true;
            } else {
                let states = element.filter_states;
                let compare = states.filter(element => locationsToFilter.includes(element));

                if(JSON.stringify(compare) === JSON.stringify(locationsToFilter)) matches.location = true;
            }
            // Product Category Check
            if(!productCategoriesToFilter.length) {
                matches.prodCategory = true;
            } else {
                let elementCategories = element.single_category;
             
                if(elementCategories !== null) {

                if (findCommonElements(productCategoriesToFilter, elementCategories)) matches.prodCategory = true;

                } 
            }
            // Country Check
            if(!countriesToFilter.length) {
                matches.country = true;
            } else {
                let elementCountry = element.made_in;
             
                if(elementCountry !== null) {

                if (findCommonElements(countriesToFilter, elementCountry)) matches.country = true;

                } 
            }
            // Vendor Check
            if(!vendorsToFilter.length) {
                matches.vendor = true;
            } else {
                let vendor = element.slug
                if(vendorsToFilter.includes(vendor)) matches.vendor = true;
            }
            // If element doesn't match all selections then hide it
            if(matches.location && matches.title && matches.vendor && matches.prodCategory && matches.country) {
                $('#job-search-result-' + element.id).removeClass('d-none');
            } else {
                $('#job-search-result-' + element.id).addClass('d-none');
            }
        });
    }
})

