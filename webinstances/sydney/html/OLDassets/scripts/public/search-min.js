$(document).ready(function(){$("#formPublicmsSearchIndex").submit(function(a){a.preventDefault();loadSearchResult("/publicms/search/result/rest/y/?q="+encodeURIComponent($("#q").val()))});if($("#q").val().length>0){loadSearchResult("/publicms/search/result/rest/y/?q="+encodeURIComponent($("#q").val()))}});function loadSearchResult(a){$("#publicmsSearchIndexLoading > img").show();$("#publicmsSearchIndexResult").load(a,function(){addEventToPaginationControl();$("#publicmsSearchIndexLoading > img").hide()})}function addEventToPaginationControl(){$("#publicmsSearchIndexPaginationControl a").each(function(a,b){$(this).click(function(c){c.preventDefault();loadSearchResult($(this).attr("href"))})})};