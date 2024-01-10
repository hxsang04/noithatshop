@extends('Layout_admin')
@section('title', 'Blogs')
@section('contect')
    <div class="page-heading">
        @include('Admin.SampleTitle')

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active clicklist" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="true">List</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link editclick" id="addproduct-tab" data-bs-toggle="tab"
                            data-bs-target="#addproduct" type="button" role="tab" aria-controls="addproduct"
                            aria-selected="false">Add</button>
                    </li>
                    <li class="nav-item dis_gal display" role="presentation">
                        <button class="nav-link galclick" id="gal-tab" data-bs-toggle="tab" data-bs-target="#gal"
                            type="button" role="tab" aria-controls="gal" aria-selected="false"></button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card-header">
                            List Datatable
                        </div>
                        <div class="card-body">
                            <table class="table" id="Loadsample">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="addproduct" role="tabpanel" aria-labelledby="addproduct-tab">
                        <div class="row match-height">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Add Product</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <form class="form" id="submit_form" action="post">
                                                <input type="hidden" id="hidden_cate_id">
                                                <div class="row">
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="first-name-column">Name</label>
                                                            <input type="text" id="blog_name" name="blog_name"
                                                                class="form-control" placeholder="Name"
                                                                name="fname-column" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="last-name-column">Content</label>
                                                            <input type="text" id="blog_content" name="blog_content"
                                                                class="form-control" placeholder="Content"
                                                                name="fname-column" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="last-name-column">Desc</label>
                                                            <textarea class="form-control" id="blog_desc" name="blog_desc"
                                                                required></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="country-floating">Category</label>
                                                            <div class="form-group">
                                                                <select class="choices form-select" id="category_blog_id"
                                                                    name="category_blog_id " required>
                                                                    @foreach ($category as $cate)
                                                                        <option value="{{ $cate->category_blog_id }}">
                                                                            {{ $cate->category_blog_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="country-floating">Status</label>
                                                            <div class="form-group">
                                                                <select class="choices form-select" id="blog_status"
                                                                    name="blog_status" required>
                                                                    <option value="1">Show</option>
                                                                    <option value="2">Hide</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="country-floating">Image</label>
                                                            <input type="file" class="basic-filepond" id="pro_image"
                                                                name="blog_image" multiple required data-max-file-size="2MB"
                                                                data-max-files="1">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-12 d-flex justify-content-end mt-3">
                                                    <input type="hidden" id="hidden_action" value="Add">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1 submit"
                                                        style="margin-bottom: -3% !important;">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>
        <!-- Basic Tables end -->
    </div>
@endsection
@section('css')
    <link rel="stylesheet"
        href="{{ asset('backend/assets/vendors/jquery-datatables/jquery.dataTables.bootstrap5.min.css') }}">
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/toastify/toastify.css') }}">
    <link href="{{ asset('frontend/parsley.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/choices.js/choices.min.css') }}" />
    <style>
        #parsley-id-29 {
            margin-top: 80px;
        }

        .click_gallery:hover {
            color: #000;
        }

        .display {
            display: none;
        }

    </style>
@endsection
@section('js')
    <script src="{{ asset('backend/assets/vendors/jquery-datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/jquery-datatables/custom.jquery.dataTables.bootstrap5.min.js') }}">
    </script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="http://parsleyjs.org/dist/parsley.js"></script>
    <script src="{{ asset('backend/assets/vendors/toastify/toastify.js') }}"></script>

    <!-- filepond validation -->
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>

    <!-- image editor -->
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js">
    </script>
    <script src="https://unpkg.com/filepond-plugin-image-filter/dist/filepond-plugin-image-filter.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    {{-- <script src="//cdn.ckeditor.com/4.17.1/basic/ckeditor.js"></script> --}}
    <script src="//cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>


        CKEDITOR.replace('blog_desc');
        CKEDITOR.config.autoParagraph = false;

        $('#submit_form').parsley();
        // register desired plugins...
        FilePond.registerPlugin(
            // validates the size of the file...
            FilePondPluginFileValidateSize,
            // validates the file type...
            FilePondPluginFileValidateType,
        );
        // Filepond: Basic
        pond = FilePond.create(
            document.querySelector('.basic-filepond'), {
                allowMultiple: true,
                instantUpload: false,
                allowProcess: false,
                acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg', 'image/webp'],
                fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
                    // Do custom type detection here and return with promise
                    resolve(type);
                })
            });

        // Load Datatable
        $('#Loadsample').DataTable({
            destroy: true,
            order: [],
            ajax: {
                url: "{{ route('blogs.index') }}",
            },
            columns: [{
                    data: 'blog_name'
                },
                {
                    data: 'image',
                    orderable: false
                },
                {
                    data: null,
                    render: function(data, type, full, meta) {
                        return '<span class="badge bg-light-primary">' + data.category_blog_name +
                            '</span>';
                    }
                },
                {
                    data: null,
                    render: function(data, type, full, meta) {
                        if (data.blog_status == 1) {
                            $output =
                                '<div class="form-check form-switch">\
                                                                                <input class="form-check-input click_status" value="' +
                                data.blog_id + '" type="checkbox" checked>\
                                                                            </div>';
                        } else {
                            $output =
                                '<div class="form-check form-switch">\
                                                                                <input class="form-check-input click_status" value="' +
                                data.blog_id + '" type="checkbox">\
                                                                            </div>';
                        }
                        return $output;
                    },
                    orderable: false
                },
                {
                    data: 'action'
                }
            ]
        });
        // Reset Form
        $('.clicklist').click(function() {
            $('#hidden_action').val('Add');
            $('.card-title').text('Add Product');
            $('.editclick').text('Add')
            $('#submit_form')[0].reset();
            $('#submit_form').parsley().reset();

            CKEDITOR.instances['pro_desc'].setData('');

        });
        // Add & Update
        $(document).on('submit', '#submit_form', function(e) {
            e.preventDefault();
            if ($('#submit_form').parsley().isValid()) {
                var action_url = '';
                var action_type = '';

                var blog_name = $('#blog_name').val();
                var blog_content = $('#blog_content').val();
                var blog_desc = $('#blog_desc').val();
                var blog_status = $('#blog_status').val();
                var category_blog_id = $('#category_blog_id').val();



                var data = new FormData(this);
                data.append('blog_name', blog_name);
                data.append('blog_content', blog_content);
                data.append('blog_desc', blog_desc);
                data.append('blog_status', blog_status);
                data.append('category_blog_id', category_blog_id);



                pondFiles = pond.getFiles();
                if (pondFiles.length > 0) {
                    data.append('blog_image', pondFiles[0].file);
                } else {
                    data.append('blog_image', '');
                }

                if ($('#hidden_action').val() == 'Add') {
                    action_url = '{{ route('blogs.store') }}';
                    data.append('_method', 'POST');
                } else {
                    var id = $('#hidden_cate_id').val();
                    action_url = 'blogs/' + id;
                    data.append('_method', 'PUT');
                }

                $.ajax({
                    type: 'post',
                    url: action_url,
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $('.submit').attr('disabled', 'disabled');
                        $('.submit').val('Submitting...');
                    },
                    success: function(res) {
                        if (res.status == 200) {
                            $('#submit_form')[0].reset();
                            $('#submit_form').parsley().reset();
                            $('.submit').attr('disabled', false);
                            $('#Loadsample').DataTable().ajax.reload();
                            $('.filepond--action-remove-item').click();

                            CKEDITOR.instances['blog_desc'].setData(' ');

                            Toastify({
                                text: "" + res.message + "",
                                duration: 3000,
                                close: true,
                                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                            }).showToast();
                            if ($('#hidden_action').val() == 'Edit') {
                                $('.clicklist').addClass('active show');
                                $('.editclick').removeClass('active show');
                                $('#home').addClass('active show');
                                $('#addproduct').removeClass('active show');
                                $('#hidden_action').val('Add');
                                $('.editclick').text('Add');
                                $('input[name="blog_image"]').attr('required', true);
                            }
                        } else {
                            $.each(res.errors, function(key, err_values) {
                                Toastify({
                                    text: "" + err_values + "",
                                    duration: 3000,
                                    close: true,
                                    backgroundColor: "#B94A48",
                                }).showToast();
                            });
                            $('.submit').attr('disabled', false);
                            $('.filepond--action-remove-item').click();
                        }
                    }
                });
            }
        });
        //Edit
        $(document).on('click', '.editsample', function(e) {
            var id = $(this).data('id');
            $('.clicklist').removeClass('active show');
            $('.editclick').addClass('active show');
            $('#home').removeClass('active show');
            $('#addproduct').addClass('active show');

            $.ajax({
                type: 'get',
                url: 'blogs/' + id,
                dataType: 'json',
                success: function(res) {
                    if (res.status == 200) {
                        $('.card-title').text('Edit Product');
                        $('#hidden_action').val('Edit');
                        $('.editclick').text('Edit "' + res.data.blog_name + '"');
                        $('#hidden_cate_id').val(id);
                        $('#blog_name').val(res.data.blog_name);
                        $('#blog_status').val(res.data.blog_status);
                        $('#blog_content').val(res.data.blog_content);
                        $('#category_blog_id').val(res.data.category_blog_id);
                        CKEDITOR.instances['blog_desc'].setData(res.data.blog_desc);


                        $('input[name="blog_image"]').attr('required', false);
                    } else {
                        alert(res.message)
                    }
                }
            });
        });
        // Delete
        $(document).on('click', '.delete', function() {
            var id = $(this).data('id');
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'delete',
                            url: 'blogs/' + id,
                            success: function(res) {
                                if (res.status == 200) {
                                    setTimeout(function() {
                                        $('#Loadsample').DataTable().ajax.reload();
                                    }, 1000);
                                    swal("Poof! " + res.message + "", {
                                        icon: "success",
                                    });
                                } else {
                                    alert(res.message);
                                }

                            }
                        });
                    } else {
                        swal("Your file is safe!", {
                            icon: "error",
                        });
                    }
                });

        });
        // Status
        {{--  $(document).on('click', '.click_status', function() {
            var checked = $(this).is(':checked');
            var id = $(this).val();
            var action = 'product';
            var statusss = '';

            if (checked == true) {
                statusss = 1;
            } else {
                statusss = 2;
            }

            $.ajax({
                type: 'post',
                url: '{{ route('home-admin.store') }}',
                data: {
                    statusss: statusss,
                    id: id,
                    action: action
                },
                success: function(res) {
                    if (res.status == 200) {
                        Toastify({
                            text: "" + res.message + "",
                            duration: 3000,
                            close: true,
                            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                        }).showToast();
                        $('#Loadsample').DataTable().ajax.reload();
                    } else {
                        alert(res.message);
                    }
                }
            });
        });  --}}

    </script>
@endsection
