
$(function () {
    if($('.current-page.adminglobal').length > 0) {
        var mparams = {
            'srvurl': '/adminglobal/services/getinstancesize/format/json',
            'columnDefs': [
                {key: 'basename', sortable: true, label: 'Webinstance Dir'},
                {key: 'human', sortable: true, label: 'Disk Used'},
                {key: 'perconhd', sortable: true, label: 'Disk %'},
                {key: 'bytes', sortable: true, label: 'Bytes'}
            ],
            'fields': ['basename', 'human', 'perconhd', 'bytes'],
            'divcontainer': 'jsondatagrid1',
            'chart': true,
            'chartparams': ["bytes", 'basename']
        };
        jsondatagrid1Obj = new ANTIDOT.datagrid(mparams);
    }
});