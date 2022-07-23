@extends("layouts.app-with-blocks")

@section('page_stylesheets')
<link rel="stylesheet" href="http://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="album py-5 bg-light">
    <div class="container">        
        
        <div class="table-responsive">
            <table id="books" class="table table-striped table-bordered table-sm" style="width:100%;">
                <thead>
                    <tr>
                        <th class="text-center">Title</th>
                        <th class="text-center">Authors</th>
                        <th class="text-center">Publishers</th>                        
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>                        
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('page_scripts')
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="http://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" defer></script>

<script defer>
    $(document).ready(function() {
        initDataTable();
    });    

    function initDataTable() {
        $('#books').DataTable({
            destroy: true,
            ajax: {
                url: base_url + 'api/v1/external/books'
            },
            columns: [{
                    data: 'title'
                },
                {
                    data: 'authors',
                    render: function(authors, type, row) {
                        let response = '<ul>';
                        authors.forEach(author => {
                            response += '<li>' + author.first_name + ' ' + author.last_name + '</li>';
                        });
                        response += '</ul>';
                        return response;
                    }
                },
                {
                    data: 'publishers',
                    render: function(publishers, type, row) {
                        let response = '<ul>';
                        publishers.forEach(publisher => {
                            response += '<li>' + publisher.name + '</li>';
                        });
                        response += '</ul>';
                        return response;
                    }
                }                
            ]            
        });       
    }
    
</script>
@endsection