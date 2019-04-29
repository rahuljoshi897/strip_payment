$(document).ready(function(){
    activateMenu('applied_jobs');
    DatatableApply.init();
});

//== Class definition

var DatatableApply = function() {
    //== Private functions
  
    // demo initializer
    var demo = function() {
  
      var datatable = $('#child_data_ajax').mDatatable({
        // datasource definition
        data: {
          type: 'remote',
          source: {
            read: {
              url: '/api/get_applied_jobs.php',
            },
          },
          pageSize: 10,
        /*  serverPaging: true,
          serverFiltering: false,
          serverSorting: true,*/
        },
  
        // layout definition
        layout: {
          theme: 'default',
          scroll: false,
          height: null,
          footer: false,
        },
  
        // column sorting
        sortable: true,
  
        pagination: true,
  
       
  
        search: {
          input: $('#generalSearch'),
        },
  
        // columns definition
        columns: [
          {
            field: 'reference_number',
            title: 'Reference number',
           
          },
          
          {
            field: 'status',
            title: 'Status',
            // callback function support for column rendering
            template: function(row) {
              var status = {
                'applied': {'title': 'applied', 'class': 'm-badge--brand'},
                'submitted': {'title': 'submitted', 'class': ' m-badge--metal'},
                'document pending': {'title': 'document pending', 'class': ' m-badge--primary'},
                'interview': {'title': 'interview', 'class': ' m-badge--success'},
                'screening': {'title': 'screening', 'class': ' m-badge--info'},
                'visa rejected ' : {'title': 'visa rejected', 'class': ' m-badge--danger'},
                'document verification': {'title': 'document verification', 'class': ' m-badge--warning'},
                'security clearance': {'title': 'security clearance', 'class': 'm-badge--brand'},
                'offered job': {'title': 'offered job', 'class': ' m-badge--metal'},
                'processing/ local transfer': {'title': 'processing/ local transfer', 'class': ' m-badge--primary'},
                'visa issued': {'title': 'visa issued', 'class': ' m-badge--success'},
                'hired': {'title': 'hired', 'class': ' m-badge--info'},
                'completed': {'title': 'completed', 'class': 'm-badge--brand'},
              };
              var clss = '';
              var ttl = '';
              if (typeof status[row.status] !=='undefined'){
                  clss = status[row.status].class;
                  ttl = status[row.status].title;
              }
              return '<span class="m-badge ' +  clss+ ' m-badge--wide">' + ttl + '</span>';
            },
          },
          {
            field: 'title',
            title: 'Job',
            // callback function support for column rendering
            template: function(row) {
            var url = "";
            if (typeof FRONTEND!=='undefined'){
                url = FRONTEND+'/job_details.php?id='+row['id'];
            }
              return '<a  target="_blank" href="'+url+'">'+row['title']+'</a>';
            },
          },

          {
            field: 'applied_date',
            title: 'Applied Date',
           
          
          }],
      });
  
     /* saved jobs */
     var datatable1 = $('#child_data_ajax1').mDatatable({
        // datasource definition
        data: {
          type: 'remote',
          source: {
            read: {
              url: '/api/get_applied_jobs.php?save',
            },
          },
          pageSize: 10,
        /*  serverPaging: true,
          serverFiltering: false,
          serverSorting: true,*/
        },
  
        // layout definition
        layout: {
          theme: 'default',
          scroll: false,
          height: null,
          footer: false,
        },
  
        // column sorting
        sortable: true,
  
        pagination: true,
  
       
  
        search: {
          input: $('#generalSearch1'),
        },
  
        // columns definition
        columns: [
            {
                field: 'title',
                title: 'Job',
                // callback function support for column rendering
                template: function(row) {
                var url = "";
                if (typeof FRONTEND!=='undefined'){
                    url = FRONTEND+'/job_details.php?id='+row['id'];
                }
                  return '<a  target="_blank" href="'+url+'">'+row['title']+'</a>';
                },
              },
          {
            field: 'save_date',
            title: 'Date',
           
          }
          
         
        ],
      });
    };
  
    return {
      //== Public functions
      init: function() {
        // init dmeo
        demo();
      },
    };
  }();
  
  