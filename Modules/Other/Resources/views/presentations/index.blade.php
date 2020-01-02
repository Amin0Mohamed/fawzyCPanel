@extends('common::layouts.app')
@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Main Programs in  presentations <a href="{{ route('presentations.create') }}" class="btn btn-dark btn-sm"> <i class="fa fa-plus"></i> Add </a></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="table-responsive">
                                @if(Session::has('message'))
                                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                @endif
                                <table id="myTable" class="table table-striped jambo_table bulk_action">
                                    <thead>
                                    <tr class="headings">
                                        <th class="column-title">ID </th>
                                        <th>Main Program</th>
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th class="column-title">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rows as $row)
                                            @if($row->main_program_id)
                                            <tr class="even pointer">
                                                <td class=" ">{{ $row->id }}</td>
                                                <td>
                                                    @foreach($main_programs as $main_program)
                                                        @if($row->main_program_id == $main_program->id)
                                                            {{ $main_program->session_name }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class=" ">{{ $row->name }}</td>
                                                <td class=" ">{{ $row->location }}</td>
                                                <td class=" ">
                                                    <form action="#" method="post">
                                                        <a href="{{ route('presentations.edit',$row->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                                        <a data-id="{{ $row->id }}" class="btn btn-danger btn-sm delete_admin"><i class="fa fa-trash-o"></i></a>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $('.delete_admin').on('click',function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $(this).parent().parent().parent().remove();
                    var id = $(this).data('id');
                    var _token = '{{ csrf_token() }}';
                    $.ajax({
                        type:'post',
                        url:'{{ route('presentations.destroy') }}',
                        data:{id:id,_token:_token},
                        success : function () {
                            Swal.fire(
                                'Success',
                                'User is Deleted Success',
                                'success'
                            )
                        },
                        beforeSend: function(){
                            $('.sendEditReq').attr('disabled','disabled');
                        },
                    });
                }
            });
        });

    </script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable({
                "columnDefs": [
                    { "orderable": false, "targets": 4 },
                ],
            });
        });
    </script>
@endpush