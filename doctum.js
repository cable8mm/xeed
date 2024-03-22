var Doctum = {
    treeJson: {"tree":{"l":0,"n":"","p":"","c":[{"l":1,"n":"Cable8mm","p":"Cable8mm","c":[{"l":2,"n":"Xeed","p":"Cable8mm/Xeed","c":[{"l":3,"n":"Command","p":"Cable8mm/Xeed/Command","c":[{"l":4,"n":"CleanCommand","p":"Cable8mm/Xeed/Command/CleanCommand"},{"l":4,"n":"GenerateDatabaseSeederCommand","p":"Cable8mm/Xeed/Command/GenerateDatabaseSeederCommand"},{"l":4,"n":"GenerateFactoriesCommand","p":"Cable8mm/Xeed/Command/GenerateFactoriesCommand"},{"l":4,"n":"GenerateMigrationsCommand","p":"Cable8mm/Xeed/Command/GenerateMigrationsCommand"},{"l":4,"n":"GenerateModelsCommand","p":"Cable8mm/Xeed/Command/GenerateModelsCommand"},{"l":4,"n":"GenerateSeedersCommand","p":"Cable8mm/Xeed/Command/GenerateSeedersCommand"},{"l":4,"n":"ImportXeedCommand","p":"Cable8mm/Xeed/Command/ImportXeedCommand"}]},{"l":3,"n":"Generators","p":"Cable8mm/Xeed/Generators","c":[{"l":4,"n":"DatabaseSeederGenerator","p":"Cable8mm/Xeed/Generators/DatabaseSeederGenerator"},{"l":4,"n":"FactoryGenerator","p":"Cable8mm/Xeed/Generators/FactoryGenerator"},{"l":4,"n":"MigrationGenerator","p":"Cable8mm/Xeed/Generators/MigrationGenerator"},{"l":4,"n":"ModelGenerator","p":"Cable8mm/Xeed/Generators/ModelGenerator"},{"l":4,"n":"SeederGenerator","p":"Cable8mm/Xeed/Generators/SeederGenerator"}]},{"l":3,"n":"Interfaces","p":"Cable8mm/Xeed/Interfaces","c":[{"l":4,"n":"GeneratorInterface","p":"Cable8mm/Xeed/Interfaces/GeneratorInterface"},{"l":4,"n":"MergerInterface","p":"Cable8mm/Xeed/Interfaces/MergerInterface"},{"l":4,"n":"ProviderInterface","p":"Cable8mm/Xeed/Interfaces/ProviderInterface"},{"l":4,"n":"ResolverInterface","p":"Cable8mm/Xeed/Interfaces/ResolverInterface"}]},{"l":3,"n":"Laravel","p":"Cable8mm/Xeed/Laravel","c":[{"l":4,"n":"Commands","p":"Cable8mm/Xeed/Laravel/Commands","c":[{"l":5,"n":"CleanCommand","p":"Cable8mm/Xeed/Laravel/Commands/CleanCommand"},{"l":5,"n":"GenerateDatabaseSeederCommand","p":"Cable8mm/Xeed/Laravel/Commands/GenerateDatabaseSeederCommand"},{"l":5,"n":"GenerateFactoriesCommand","p":"Cable8mm/Xeed/Laravel/Commands/GenerateFactoriesCommand"},{"l":5,"n":"GenerateMigrationsCommand","p":"Cable8mm/Xeed/Laravel/Commands/GenerateMigrationsCommand"},{"l":5,"n":"GenerateModelsCommand","p":"Cable8mm/Xeed/Laravel/Commands/GenerateModelsCommand"},{"l":5,"n":"GenerateSeedersCommand","p":"Cable8mm/Xeed/Laravel/Commands/GenerateSeedersCommand"},{"l":5,"n":"ImportXeedCommand","p":"Cable8mm/Xeed/Laravel/Commands/ImportXeedCommand"}]},{"l":4,"n":"XeedFacade","p":"Cable8mm/Xeed/Laravel/XeedFacade"},{"l":4,"n":"XeedServiceProvider","p":"Cable8mm/Xeed/Laravel/XeedServiceProvider"}]},{"l":3,"n":"Mergers","p":"Cable8mm/Xeed/Mergers","c":[{"l":4,"n":"Merger","p":"Cable8mm/Xeed/Mergers/Merger"},{"l":4,"n":"MergerContainer","p":"Cable8mm/Xeed/Mergers/MergerContainer"},{"l":4,"n":"MorphsMerger","p":"Cable8mm/Xeed/Mergers/MorphsMerger"},{"l":4,"n":"NullableMorphsMerger","p":"Cable8mm/Xeed/Mergers/NullableMorphsMerger"},{"l":4,"n":"NullableUlidMorphsMerger","p":"Cable8mm/Xeed/Mergers/NullableUlidMorphsMerger"},{"l":4,"n":"NullableUuidMorphsMerger","p":"Cable8mm/Xeed/Mergers/NullableUuidMorphsMerger"},{"l":4,"n":"TimestampsMerger","p":"Cable8mm/Xeed/Mergers/TimestampsMerger"},{"l":4,"n":"UlidMorphsMerger","p":"Cable8mm/Xeed/Mergers/UlidMorphsMerger"},{"l":4,"n":"UuidMorphsMerger","p":"Cable8mm/Xeed/Mergers/UuidMorphsMerger"}]},{"l":3,"n":"Provider","p":"Cable8mm/Xeed/Provider","c":[{"l":4,"n":"MysqlProvider","p":"Cable8mm/Xeed/Provider/MysqlProvider"},{"l":4,"n":"PgsqlProvider","p":"Cable8mm/Xeed/Provider/PgsqlProvider"},{"l":4,"n":"SqliteProvider","p":"Cable8mm/Xeed/Provider/SqliteProvider"}]},{"l":3,"n":"Resolvers","p":"Cable8mm/Xeed/Resolvers","c":[{"l":4,"n":"BigintResolver","p":"Cable8mm/Xeed/Resolvers/BigintResolver"},{"l":4,"n":"BinaryResolver","p":"Cable8mm/Xeed/Resolvers/BinaryResolver"},{"l":4,"n":"BitResolver","p":"Cable8mm/Xeed/Resolvers/BitResolver"},{"l":4,"n":"BlobResolver","p":"Cable8mm/Xeed/Resolvers/BlobResolver"},{"l":4,"n":"BoolResolver","p":"Cable8mm/Xeed/Resolvers/BoolResolver"},{"l":4,"n":"BooleanResolver","p":"Cable8mm/Xeed/Resolvers/BooleanResolver"},{"l":4,"n":"CharResolver","p":"Cable8mm/Xeed/Resolvers/CharResolver"},{"l":4,"n":"DateResolver","p":"Cable8mm/Xeed/Resolvers/DateResolver"},{"l":4,"n":"DateTimeTzResolver","p":"Cable8mm/Xeed/Resolvers/DateTimeTzResolver"},{"l":4,"n":"DatetimeResolver","p":"Cable8mm/Xeed/Resolvers/DatetimeResolver"},{"l":4,"n":"DecResolver","p":"Cable8mm/Xeed/Resolvers/DecResolver"},{"l":4,"n":"DecimalResolver","p":"Cable8mm/Xeed/Resolvers/DecimalResolver"},{"l":4,"n":"DoubleResolver","p":"Cable8mm/Xeed/Resolvers/DoubleResolver"},{"l":4,"n":"EnumResolver","p":"Cable8mm/Xeed/Resolvers/EnumResolver"},{"l":4,"n":"FloatResolver","p":"Cable8mm/Xeed/Resolvers/FloatResolver"},{"l":4,"n":"GeometryResolver","p":"Cable8mm/Xeed/Resolvers/GeometryResolver"},{"l":4,"n":"IdResolver","p":"Cable8mm/Xeed/Resolvers/IdResolver"},{"l":4,"n":"InetResolver","p":"Cable8mm/Xeed/Resolvers/InetResolver"},{"l":4,"n":"IntResolver","p":"Cable8mm/Xeed/Resolvers/IntResolver"},{"l":4,"n":"IntegerResolver","p":"Cable8mm/Xeed/Resolvers/IntegerResolver"},{"l":4,"n":"JsonResolver","p":"Cable8mm/Xeed/Resolvers/JsonResolver"},{"l":4,"n":"JsonbResolver","p":"Cable8mm/Xeed/Resolvers/JsonbResolver"},{"l":4,"n":"LongblobResolver","p":"Cable8mm/Xeed/Resolvers/LongblobResolver"},{"l":4,"n":"LongtextResolver","p":"Cable8mm/Xeed/Resolvers/LongtextResolver"},{"l":4,"n":"MacaddressResolver","p":"Cable8mm/Xeed/Resolvers/MacaddressResolver"},{"l":4,"n":"MediumblobResolver","p":"Cable8mm/Xeed/Resolvers/MediumblobResolver"},{"l":4,"n":"MediumintResolver","p":"Cable8mm/Xeed/Resolvers/MediumintResolver"},{"l":4,"n":"MediumtextResolver","p":"Cable8mm/Xeed/Resolvers/MediumtextResolver"},{"l":4,"n":"MorphsResolver","p":"Cable8mm/Xeed/Resolvers/MorphsResolver"},{"l":4,"n":"MultilinestringResolver","p":"Cable8mm/Xeed/Resolvers/MultilinestringResolver"},{"l":4,"n":"MultipointResolver","p":"Cable8mm/Xeed/Resolvers/MultipointResolver"},{"l":4,"n":"NumericResolver","p":"Cable8mm/Xeed/Resolvers/NumericResolver"},{"l":4,"n":"RemembertokenResolver","p":"Cable8mm/Xeed/Resolvers/RemembertokenResolver"},{"l":4,"n":"Resolver","p":"Cable8mm/Xeed/Resolvers/Resolver"},{"l":4,"n":"SmallintResolver","p":"Cable8mm/Xeed/Resolvers/SmallintResolver"},{"l":4,"n":"StringResolver","p":"Cable8mm/Xeed/Resolvers/StringResolver"},{"l":4,"n":"TextResolver","p":"Cable8mm/Xeed/Resolvers/TextResolver"},{"l":4,"n":"TimeResolver","p":"Cable8mm/Xeed/Resolvers/TimeResolver"},{"l":4,"n":"TimeTzResolver","p":"Cable8mm/Xeed/Resolvers/TimeTzResolver"},{"l":4,"n":"TimestampResolver","p":"Cable8mm/Xeed/Resolvers/TimestampResolver"},{"l":4,"n":"TinyblobResolver","p":"Cable8mm/Xeed/Resolvers/TinyblobResolver"},{"l":4,"n":"TinyintResolver","p":"Cable8mm/Xeed/Resolvers/TinyintResolver"},{"l":4,"n":"TinytextResolver","p":"Cable8mm/Xeed/Resolvers/TinytextResolver"},{"l":4,"n":"UlidResolver","p":"Cable8mm/Xeed/Resolvers/UlidResolver"},{"l":4,"n":"UlidmorphsResolver","p":"Cable8mm/Xeed/Resolvers/UlidmorphsResolver"},{"l":4,"n":"UuidResolver","p":"Cable8mm/Xeed/Resolvers/UuidResolver"},{"l":4,"n":"UuidmorphsResolver","p":"Cable8mm/Xeed/Resolvers/UuidmorphsResolver"},{"l":4,"n":"VarbinaryResolver","p":"Cable8mm/Xeed/Resolvers/VarbinaryResolver"},{"l":4,"n":"VarcharResolver","p":"Cable8mm/Xeed/Resolvers/VarcharResolver"},{"l":4,"n":"YearResolver","p":"Cable8mm/Xeed/Resolvers/YearResolver"}]},{"l":3,"n":"Support","p":"Cable8mm/Xeed/Support","c":[{"l":4,"n":"File","p":"Cable8mm/Xeed/Support/File"},{"l":4,"n":"Inflector","p":"Cable8mm/Xeed/Support/Inflector"},{"l":4,"n":"Path","p":"Cable8mm/Xeed/Support/Path"},{"l":4,"n":"Picker","p":"Cable8mm/Xeed/Support/Picker"}]},{"l":3,"n":"Types","p":"Cable8mm/Xeed/Types","c":[{"l":4,"n":"Bracket","p":"Cable8mm/Xeed/Types/Bracket"}]},{"l":3,"n":"Column","p":"Cable8mm/Xeed/Column"},{"l":3,"n":"ResolverSelector","p":"Cable8mm/Xeed/ResolverSelector"},{"l":3,"n":"Table","p":"Cable8mm/Xeed/Table"},{"l":3,"n":"Xeed","p":"Cable8mm/Xeed/Xeed"}]}]}]},"treeOpenLevel":2},
    /** @var boolean */
    treeLoaded: false,
    /** @var boolean */
    listenersRegistered: false,
    autoCompleteData: null,
    /** @var boolean */
    autoCompleteLoading: false,
    /** @var boolean */
    autoCompleteLoaded: false,
    /** @var string|null */
    rootPath: null,
    /** @var string|null */
    autoCompleteDataUrl: null,
    /** @var HTMLElement|null */
    doctumSearchAutoComplete: null,
    /** @var HTMLElement|null */
    doctumSearchAutoCompleteProgressBarContainer: null,
    /** @var HTMLElement|null */
    doctumSearchAutoCompleteProgressBar: null,
    /** @var number */
    doctumSearchAutoCompleteProgressBarPercent: 0,
    /** @var autoComplete|null */
    autoCompleteJS: null,
    querySearchSecurityRegex: /([^0-9a-zA-Z:\\\\_\s])/gi,
    buildTreeNode: function (treeNode, htmlNode, treeOpenLevel) {
        var ulNode = document.createElement('ul');
        for (var childKey in treeNode.c) {
            var child = treeNode.c[childKey];
            var liClass = document.createElement('li');
            var hasChildren = child.hasOwnProperty('c');
            var nodeSpecialName = (hasChildren ? 'namespace:' : 'class:') + child.p.replace(/\//g, '_');
            liClass.setAttribute('data-name', nodeSpecialName);

            // Create the node that will have the text
            var divHd = document.createElement('div');
            var levelCss = child.l - 1;
            divHd.className = hasChildren ? 'hd' : 'hd leaf';
            divHd.style.paddingLeft = (hasChildren ? (levelCss * 18) : (8 + (levelCss * 18))) + 'px';
            if (hasChildren) {
                if (child.l <= treeOpenLevel) {
                    liClass.className = 'opened';
                }
                var spanIcon = document.createElement('span');
                spanIcon.className = 'icon icon-play';
                divHd.appendChild(spanIcon);
            }
            var aLink = document.createElement('a');

            // Edit the HTML link to work correctly based on the current depth
            aLink.href = Doctum.rootPath + child.p + '.html';
            aLink.innerText = child.n;
            divHd.appendChild(aLink);
            liClass.appendChild(divHd);

            // It has children
            if (hasChildren) {
                var divBd = document.createElement('div');
                divBd.className = 'bd';
                Doctum.buildTreeNode(child, divBd, treeOpenLevel);
                liClass.appendChild(divBd);
            }
            ulNode.appendChild(liClass);
        }
        htmlNode.appendChild(ulNode);
    },
    initListeners: function () {
        if (Doctum.listenersRegistered) {
            // Quick exit, already registered
            return;
        }
                Doctum.listenersRegistered = true;
    },
    loadTree: function () {
        if (Doctum.treeLoaded) {
            // Quick exit, already registered
            return;
        }
        Doctum.rootPath = document.body.getAttribute('data-root-path');
        Doctum.buildTreeNode(Doctum.treeJson.tree, document.getElementById('api-tree'), Doctum.treeJson.treeOpenLevel);

        // Toggle left-nav divs on click
        $('#api-tree .hd span').on('click', function () {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }
        Doctum.treeLoaded = true;
    },
    pagePartiallyLoaded: function (event) {
        Doctum.initListeners();
        Doctum.loadTree();
        Doctum.loadAutoComplete();
    },
    pageFullyLoaded: function (event) {
        // it may not have received DOMContentLoaded event
        Doctum.initListeners();
        Doctum.loadTree();
        Doctum.loadAutoComplete();
        // Fire the event in the search page too
        if (typeof DoctumSearch === 'object') {
            DoctumSearch.pageFullyLoaded();
        }
    },
    loadAutoComplete: function () {
        if (Doctum.autoCompleteLoaded) {
            // Quick exit, already loaded
            return;
        }
        Doctum.autoCompleteDataUrl = document.body.getAttribute('data-search-index-url');
        Doctum.doctumSearchAutoComplete = document.getElementById('doctum-search-auto-complete');
        Doctum.doctumSearchAutoCompleteProgressBarContainer = document.getElementById('search-progress-bar-container');
        Doctum.doctumSearchAutoCompleteProgressBar = document.getElementById('search-progress-bar');
        if (Doctum.doctumSearchAutoComplete !== null) {
            // Wait for it to be loaded
            Doctum.doctumSearchAutoComplete.addEventListener('init', function (_) {
                Doctum.autoCompleteLoaded = true;
                Doctum.doctumSearchAutoComplete.addEventListener('selection', function (event) {
                    // Go to selection page
                    window.location = Doctum.rootPath + event.detail.selection.value.p;
                });
                Doctum.doctumSearchAutoComplete.addEventListener('navigate', function (event) {
                    // Set selection in text box
                    if (typeof event.detail.selection.value === 'object') {
                        Doctum.doctumSearchAutoComplete.value = event.detail.selection.value.n;
                    }
                });
                Doctum.doctumSearchAutoComplete.addEventListener('results', function (event) {
                    Doctum.markProgressFinished();
                });
            });
        }
        // Check if the lib is loaded
        if (typeof autoComplete === 'function') {
            Doctum.bootAutoComplete();
        }
    },
    markInProgress: function () {
            Doctum.doctumSearchAutoCompleteProgressBarContainer.className = 'search-bar';
            Doctum.doctumSearchAutoCompleteProgressBar.className = 'progress-bar indeterminate';
            if (typeof DoctumSearch === 'object' && DoctumSearch.pageFullyLoaded) {
                DoctumSearch.doctumSearchPageAutoCompleteProgressBarContainer.className = 'search-bar';
                DoctumSearch.doctumSearchPageAutoCompleteProgressBar.className = 'progress-bar indeterminate';
            }
    },
    markProgressFinished: function () {
        Doctum.doctumSearchAutoCompleteProgressBarContainer.className = 'search-bar hidden';
        Doctum.doctumSearchAutoCompleteProgressBar.className = 'progress-bar';
        if (typeof DoctumSearch === 'object' && DoctumSearch.pageFullyLoaded) {
            DoctumSearch.doctumSearchPageAutoCompleteProgressBarContainer.className = 'search-bar hidden';
            DoctumSearch.doctumSearchPageAutoCompleteProgressBar.className = 'progress-bar';
        }
    },
    makeProgess: function () {
        Doctum.makeProgressOnProgressBar(
            Doctum.doctumSearchAutoCompleteProgressBarPercent,
            Doctum.doctumSearchAutoCompleteProgressBar
        );
        if (typeof DoctumSearch === 'object' && DoctumSearch.pageFullyLoaded) {
            Doctum.makeProgressOnProgressBar(
                Doctum.doctumSearchAutoCompleteProgressBarPercent,
                DoctumSearch.doctumSearchPageAutoCompleteProgressBar
            );
        }
    },
    loadAutoCompleteData: function (query) {
        return new Promise(function (resolve, reject) {
            if (Doctum.autoCompleteData !== null) {
                resolve(Doctum.autoCompleteData);
                return;
            }
            Doctum.markInProgress();
            function reqListener() {
                Doctum.autoCompleteLoading = false;
                Doctum.autoCompleteData = JSON.parse(this.responseText).items;
                Doctum.markProgressFinished();

                setTimeout(function () {
                    resolve(Doctum.autoCompleteData);
                }, 50);// Let the UI render once before sending the results for processing. This gives time to the progress bar to hide
            }
            function reqError(err) {
                Doctum.autoCompleteLoading = false;
                Doctum.autoCompleteData = null;
                console.error(err);
                reject(err);
            }

            var oReq = new XMLHttpRequest();
            oReq.onload = reqListener;
            oReq.onerror = reqError;
            oReq.onprogress = function (pe) {
                if (pe.lengthComputable) {
                    Doctum.doctumSearchAutoCompleteProgressBarPercent = parseInt(pe.loaded / pe.total * 100, 10);
                    Doctum.makeProgess();
                }
            };
            oReq.onloadend = function (_) {
                Doctum.markProgressFinished();
            };
            oReq.open('get', Doctum.autoCompleteDataUrl, true);
            oReq.send();
        });
    },
    /**
     * Make some progress on a progress bar
     *
     * @param number percentage
     * @param HTMLElement progressBar
     * @return void
     */
    makeProgressOnProgressBar: function(percentage, progressBar) {
        progressBar.className = 'progress-bar';
        progressBar.style.width = percentage + '%';
        progressBar.setAttribute(
            'aria-valuenow', percentage
        );
    },
    searchEngine: function (query, record) {
        if (typeof query !== 'string') {
            return '';
        }
        // replace all (mode = g) spaces and non breaking spaces (\s) by pipes
        // g = global mode to mark also the second word searched
        // i = case insensitive
        // how this function works:
        // First: search if the query has the keywords in sequence
        // Second: replace the keywords by a mark and leave all the text in between non marked
        
        if (record.match(new RegExp('(' + query.replace(/\s/g, ').*(') + ')', 'gi')) === null) {
            return '';// Does not match
        }

        var replacedRecord = record.replace(new RegExp('(' + query.replace(/\s/g, '|') + ')', 'gi'), function (group) {
            return '<mark class="auto-complete-highlight">' + group + '</mark>';
        });

        if (replacedRecord !== record) {
            return replacedRecord;// This should not happen but just in case there was no match done
        }

        return '';
    },
    /**
     * Clean the search query
     *
     * @param string query
     * @return string
     */
    cleanSearchQuery: function (query) {
        // replace any chars that could lead to injecting code in our regex
        // remove start or end spaces
        // replace backslashes by an escaped version, use case in search: \myRootFunction
        return query.replace(Doctum.querySearchSecurityRegex, '').trim().replace(/\\/g, '\\\\');
    },
    bootAutoComplete: function () {
        Doctum.autoCompleteJS = new autoComplete(
            {
                selector: '#doctum-search-auto-complete',
                searchEngine: function (query, record) {
                    return Doctum.searchEngine(query, record);
                },
                submit: true,
                data: {
                    src: function (q) {
                        Doctum.markInProgress();
                        return Doctum.loadAutoCompleteData(q);
                    },
                    keys: ['n'],// Data 'Object' key to be searched
                    cache: false, // Is not compatible with async fetch of data
                },
                query: (input) => {
                    return Doctum.cleanSearchQuery(input);
                },
                trigger: (query) => {
                    return Doctum.cleanSearchQuery(query).length > 0;
                },
                resultsList: {
                    tag: 'ul',
                    class: 'auto-complete-dropdown-menu',
                    destination: '#auto-complete-results',
                    position: 'afterbegin',
                    maxResults: 500,
                    noResults: false,
                },
                resultItem: {
                    tag: 'li',
                    class: 'auto-complete-result',
                    highlight: 'auto-complete-highlight',
                    selected: 'auto-complete-selected'
                },
            }
        );
    }
};


document.addEventListener('DOMContentLoaded', Doctum.pagePartiallyLoaded, false);
window.addEventListener('load', Doctum.pageFullyLoaded, false);
