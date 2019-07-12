<template>
    <div>
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h5> Blogs Table</h5>
                </div>
                <div class="card-tools float-right">
                    <button class="btn btn-success" @click.prevent="newModal"
                    >
                        <i class="fa fa-plus"></i>
                        Add Blog
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                                   aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1"
                                        aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending"
                                        style="width: 203.4px;">
                                        <i class="fa fa-tags"></i> Title
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending" style="width: 262.6px;">
                                        <i class="fa fa-blog"></i>
                                        Content
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 233px;">
                                        <i class="fa fa-image"></i>
                                        Featured Image
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 33px;">
                                        <i class="fa fa-circle-o-notch"></i>
                                        Status
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="CSS grade: activate to sort column ascending"
                                        style="width: 123.6px;">
                                        <i class="fa fa-edit"></i>
                                        Modify
                                    </th>
                                </tr>
                                </thead>
                                <tbody>


                                <tr role="row" class="odd"
                                    v-for="(blog, $index) in blogs"
                                    :key="$index"
                                >
                                    <td>
                                        {{blog.title}}
                                    </td>
                                    <td v-html="blog.content.substr(0,100)" title="blog.content"></td>
                                    <td><img src="uploads/" alt="">{{blog.featured_image}}</td>
                                    <td>{{blog.status}}</td>
                                    <td>
                                        <div class="btn-group">

                                            <i class="fa fa-edit green" title="Edit"
                                               @click.prevent="editModal(blog)"></i>
                                            &nbsp;&nbsp;&nbsp;
                                            <i class="fa fa-trash red" title="Delete"
                                               @click.prevent="deleteBlog(blog.slug)"></i>

                                        </div>

                                    </td>

                                </tr>
                                <infinite-loading
                                        spinner="spiral"
                                        @distance="100"
                                        force-use-infinite-wrapper="true"
                                        @infinite=" infiniteHandler ">
                                    <span slot="no-more"></span>
                                </infinite-loading>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="addBlogModel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
             aria-hidden="true">
            <div class="modal-dialog modal-full" role="document">
                <div class="modal-content modal-margin-left">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-plus"></i>
                            {{editMode ? 'Update' :'Add New'}} Blog
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editMode ? updateBlog(): addBlog()">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <alert-error :form="form"></alert-error>
                                <div class="form-group">
                                    <i class="fa fa-mail-bulk"></i>
                                    <label for="title">Title</label>
                                    <input type="text"
                                           name="title" id="title"
                                           required
                                           v-model="form.title"
                                           class="form-control"
                                           :class="{ 'is-invalid': form.errors.has('title') }"
                                           placeholder="Enter Title Here ?">
                                    <has-error :form="form" field="title"></has-error>
                                </div>

                                <label class-="fa fa-blogs">Content</label>
                                <ckeditor :editor="editor" v-model="form.content" :config="editorConfig"></ckeditor>


                                <has-error :form="form" field="content"></has-error>

                                <div class="form-group">
                                    <i class="fa fa-check-circle"></i>
                                    <label for="status">Status</label>
                                    <select class="form-control" :class="{'is-invalid': form.errors.has('status')}"
                                            required
                                            name="status"
                                            id="status"
                                            v-model="form.status"
                                    >
                                        <option value="1">Active</option>
                                        <option value="0">In-Active</option>
                                    </select>
                                    <has-error :form="form" field="status"></has-error>
                                </div>

                                <div class="form-group">
                                    <i class="fa fa-image"></i>
                                    <label for="featured_image">Image</label>
                                    <input type="file"
                                           name="featured_image" id="featured_image"
                                           :class="{ 'is-invalid': form.errors.has('featured_image') }">
                                    <has-error :form="form" field="featured_image"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <i class="fa fa-close"></i> Close
                            </button>
                            <button type="submit" :disabled="form.busy" class="btn btn-success">
                                <i class="fa fa-save"></i> {{editMode ? 'Update' :'save'}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
    import {Form, HasError, AlertError} from 'vform';
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import axios from 'axios';


    export default {
        name: "Blog",
        components: {
            name: {
                HasError,
                AlertError,

            }
        },
        data() {
            return {
                blogs: [],
                page: 1,
                editMode: true,
                form: new Form({
                    id: '',
                    title: '',
                    content: '',
                    featured_image: '',
                    status: '',
                }),
                editor:
                ClassicEditor,
                editorConfig:
                    {}
            }
        },
        methods: {
            newModal() {
                this.editMode = false;
                this.form.reset();
                $('#addBlogModel').modal('show');


            },
            editModal(slug) {
                this.editMode = true;
                this.form.fill(slug);
                $('#addBlogModel').modal('show');


            },
            addBlog() {
                let formData = new FormData();
                formData.append('featured_image', this.featured_image);
                axios.post('api/v1/blog', this.form)
                    .then(res => {
                        this.$Progress.start();
                        let payload = {
                            title: this.form.title,
                            featured_image: this.form.featured_image,
                            status: this.form.status,
                            content: this.form.content.substr(0, 100),
                        };
                        console.log(payload);
                        // this.blogs.push(payload);
                        this.blogs = [payload, ...this.blogs];
                        $('#addBlogModel').modal('hide');
                        Toast.fire({
                            type: 'success',
                            title: 'Congratulations'
                        });
                        this.form.reset();
                        this.$Progress.finish();


                    })
                    .catch(err => {
                        this.$Progress.fail();
                        Toast.fire({
                            type: 'error',
                            title: 'Something went wrong'
                        });
                        this.form.fill();
                        $('#addBlogModel').modal('show');
                    })

            },
            updateBlog() {
                this.form.put('api/v1/blog/' + this.form.id)
                    .then(res => {
                        this.$Progress.start();
                        $('#addBlogModel').modal('hide');
                        this.$Progress.finish();
                        Toast.fire({
                            type: 'success',
                            title: 'Blog Updated successfully'
                        });
                    })
                    .catch(err => {
                        Toast.fire({
                            type: 'error',
                            title: 'Something went wrong '
                        });
                        this.$Progress.fail();
                    })
            },
            deleteBlog(slug) {
                SwalDeleteAlert.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/api/v1/blog/' + slug).then(res => {
                            this.$Progress.start();
                            let index = this.blogs.findIndex(item => item.slug === slug);
                            this.blogs.splice(index, 1);
                            SwalDeleteAlert.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                            this.$Progress.finish();
                        }).catch(err => {
                            console.log(err)
                        });

                    } else if (
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        SwalDeleteAlert.fire(
                            'Cancelled',
                            'Your Data is safe :)',
                            'error'
                        )
                    }
                });
            },
            infiniteHandler($state) {
                axios.get('api/v1/blogs?page=' + this.page)
                    .then(res => {
                        if (res.data.data.length) {
                            this.page += 1;
                            this.blogs.push(...res.data.data);
                            $state.loaded();
                        } else {
                            $state.complete();
                        }
                    });
            },
        },
        mounted() {
            this.$store.dispatch('fetchBlog');
        },
        computed: {}
    }
</script>
<style>
    .modal-full {
        min-width: 80%;

    }

    .modal-margin-left {
        margin-left: 144px;
        margin-top: 100px;
    }

</style>
