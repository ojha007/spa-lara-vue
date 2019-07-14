<template>
    <div>
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h5> Brand Table</h5>
                </div>
                <div class="card-tools float-right">
                    <button class="btn btn-success" @click.prevent="newModal"
                    >
                        <i class="fa fa-user-plus"></i>
                        Add Brand
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
                                <tr>
                                    <th>
                                        <i class="fa fa-tags"></i> Brand Name
                                    </th>
                                    <th>
                                        <i class="fa fa-image"></i>
                                        Featured Image
                                    </th>
                                    <th>
                                        <i class="fa fa-star"></i>
                                        Display Order
                                        <span @click.prevent="display_Odering" style="cursor: pointer;">
                                            <i class="fa fa-arrow-up float-right"></i>
                                            <i class="fa fa-arrow-down float-right"></i>
                                       </span>
                                    </th>

                                    <th>
                                        <i class="fa fa-edit"></i>
                                        Modify
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr role="row" class="odd"
                                    v-for="(brand,index) in brands"
                                    :key="brand.id"

                                >
                                    <td>
                                        {{brand.name}}
                                    </td>
                                    <td>
                                        {{brand.featured_image}}
                                    </td>
                                    <td>
                                        {{brand.display_order}}
                                    </td>

                                    <td>
                                        <div class="btn-group">
                                            <i class="fa fa-eye yellow" title="Detail"
                                               @click.prevent="brandDetail(brand.id)"></i>
                                            &nbsp;&nbsp;&nbsp;
                                            <i class="fa fa-edit green" title="Edit"
                                               @click.prevent="editModal(brand)"></i>
                                            &nbsp;&nbsp;&nbsp;
                                            <i class="fa fa-trash red" title="Delete"
                                               @click.prevent="deleteBrand(brand.id)"></i>

                                        </div>

                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="brandModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-if="!viewMode">
                            <i class="fa fa-plus-circle"></i>
                            {{editMode ? 'Update':'Add New'}} Brand
                        </h5>
                        <h5 v-else>Brand Detail </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent=" editMode ? storeBrand : updateBrand">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <table class="table table-bordered ">
                                    <tbody>
                                    <tr>
                                        <th>Brand Title</th>

                                        <td>
                                            <div class="form-group">
                                                <label></label>
                                                <input type="text" name="name" class="form-control"
                                                       required v-model="form.name" v-if="!viewMode">
                                                <div v-if="viewMode">
                                                    <p>{{form.name}}</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Brand Name</th>
                                        <td>
                                            <div class="form-group">
                                                <label></label>
                                                <input type="number" name="display_order" class="form-control"
                                                       required v-model="form.display_order" v-if="!viewMode">
                                                <p v-if="viewMode">
                                                    {{form.display_order}}
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <i class="fa  fa-close green"></i> Close
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save"></i> Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
    import Form from 'vform';

    export default {
        name: 'Brand',
        data() {
            return {
                changeProduct: 1,
                page: 1,
                editMode: true,
                viewMode: false,
                ascending: false,
                form: new Form({
                    name: '',
                    display_order: ''

                }),


            }
        },
        methods: {
            display_Odering() {
                this.ascending = !this.ascending;
                if (this.ascending === true) {
                    this.brands.sort((a, b) => {
                        return parseInt(a.display_order) - parseInt(b.display_order);
                    })
                } else {
                    return this.brands;
                }
            },
            infiniteHandler($state) {
                let vm = this;
                axios.get('api/v1/product', {
                        params: {
                            page: this.page,
                            tags: this.changeProduct,
                        }
                    }
                )
                    .then(response => {
                        return response.data;
                    }).then(data => {
                    $.each(data.data, function (key, value) {
                        vm.products.push(value);
                    });
                    $state.loaded();
                });

                this.page = this.page + 1;
            },
            storeBrand() {
                // axios.post('api/v1/product',this.form)
                console.log(this.form);

            },
            brandDetail(brand) {
                this.viewMode = true;
                axios.get('api/v1/brand/' + brand)
                    .then(res => {
                        $('#brandModal').modal('show')
                    })
            },
            selectBrand() {
                axios.get('api/v1/brands')
                    .then(res => {
                        this.selectBrands = res.data.data;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            newModal() {
                this.editMode = false;
                this.viewMode = false;
                this.form.reset();
                $('#brandModal').modal('show');

            },
            editModal(brand) {
                this.editMode = true;
                this.viewMode = false;
                this.form.fill(brand);
                $('#brandModal').modal('show');

            },
            deleteBrand(id) {
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
                        axios.delete('/api/v1/product/' + id).then(res => {
                            this.$Progress.start();
                            let index = this.products.findIndex(item => item.id === id);
                            this.products.splice(index, 1);
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
            filterProduct() {
                this.page = 1;
                this.products = [];
            },
            updateBrand() {
            }
        },
        mounted() {
            this.$store.dispatch('selectBrand');

        },
        computed: {
            brands() {
                return this.$store.state.brands;
            },

        }

    }
</script>
