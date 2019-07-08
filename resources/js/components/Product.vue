<template>
    <div>
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h5> Product Table</h5>
                </div>


                <div class="card-tools float-right">
                    <button class="btn btn-success" @click.prevent="newModal"
                    >
                        <i class="fa fa-user-plus"></i>
                        Add Product
                    </button>
                </div>
            </div>
            <div class="col-md-2 mt-4 ml-2">
                <select @change="filterProduct" v-model="changeProduct">
                    <option selected>--Filter Product--</option>
                    <option value="1">By Price</option>
                    <option value="2">By Released Data</option>
                </select>
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
                                        <i class="fa fa-tags"></i> Product Name
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 233px;">
                                        <i class="fa fa-image"></i>
                                        Featured Image
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="CSS grade: activate to sort column ascending"
                                        style="width: 123.6px;">
                                        <i class="fa fa-tags"></i>
                                        Brand Name
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
                                    v-for="product in products"
                                    :key="product.id"

                                >
                                    <td>
                                        {{product.name}}
                                    </td>
                                    <td>
                                        {{product.featured_image}}
                                    </td>
                                    <td>
                                        {{product.brand.name}}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <i class="fa fa-eye yellow" title="Detail"
                                               @click.prevent="productDetail(product.id)"></i>
                                            &nbsp;&nbsp;&nbsp;
                                            <i class="fa fa-edit green" title="Edit"
                                               @click.prevent="editModal(product)"></i>
                                            &nbsp;&nbsp;&nbsp;
                                            <i class="fa fa-trash red" title="Delete"
                                               @click.prevent="deleteProduct(product.id)"></i>

                                        </div>

                                    </td>

                                </tr>
                                <div style="overflow: auto;">
                                    <infinite-loading
                                            :identifier="changeProduct"
                                            @distance="100"
                                            @infinite="infiniteHandler"
                                            force-use-infinite-wrapper="true"></infinite-loading>
                                </div>


                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
             aria-hidden="true">
            <div class="modal-dialog modal-full" role="document">
                <div class="modal-content modal-margin-left">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-plus-circle"></i>
                            Add New Product
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="storeProduct">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <table class="table table-bordered ">
                                    <tbody>
                                    <tr>
                                        <th>Product Name</th>
                                        <td>
                                            <div class="form-group">
                                                <label></label>
                                                <input type="text" name="name" class="form-control"
                                                       required v-model="form.name">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Product Brand</th>
                                        <td>
                                            <div class="form-group">
                                                <label for="selectBrand"></label>
                                                <select name="meta_value" id="selectBrand"
                                                        class="form-control" v-model="form.brand_id" required>
                                                    <option :value="brand.id"
                                                            :key="brand.id"

                                                            v-for="brand in brands">
                                                        {{brand.name}}
                                                    </option>
                                                </select>

                                            </div>
                                        </td>

                                    </tr>
                                    <tr v-for="meta_key in meta_keys">
                                        <th>
                                            {{meta_key.meta_name}}
                                        </th>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                       v-model="'meta_key[\''+meta_key.slug+'\']'"
                                                       :name="'meta_key[\''+meta_key.slug+'\']'">
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

        <div class="modal fade" id="product-detail" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
             aria-hidden="true">
            <div class="modal-dialog  modal-full" role="document">
                <div class="modal-content modal-margin-left">
                    <div class="modal-header">
                        <h5 class="modal-title">Product Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class=" table table-bordered table-hover">
                            <tbody>
                            <tr>
                                <th>Product Name</th>
                                <td v-model="product">{{product.name}}</td>
                            </tr>
                            <tr>
                                <th>Product Brand</th>
                                <td v-model="brand">{{brand.name}}</td>

                            </tr>
                            <tr v-for="meta_value in meta_values">
                                <th>
                                    {{meta_value.meta.meta_name}}

                                </th>
                                <td>{{meta_value.meta_value}}</td>


                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>


    </div>

</template>
<script>
    import Form from 'vform';

    export default {
        name: 'Product',
        data() {
            return {
                changeProduct: 1,
                products: [],
                page: 1,
                form: new Form({
                    name: '',
                    brand_id: '',
                    product_meta_key: ''
                }),
                selectBrands: [],
                selectMetaKeys: [],
                brand: [],
                meta_values: [],
                product: [],

            }
        },
        methods: {

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
            storeProduct() {
                // axios.post('api/v1/product',this.form)
                console.log(this.form);

            },
            productDetail(product) {
                axios.get('api/v1/product/' + product)
                    .then(res => {
                        this.brand = res.data.brand;
                        this.meta_values = res.data.meta_value;
                        this.product = res.data.name;

                        $('#product-detail').modal('show')
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
            selectMetaKey() {
                axios.get('api/v1/meta_keys')
                    .then(res => {
                        this.selectMetaKeys = res.data;
                        this.form.product_meta_key = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            newModal() {
                $('#addProduct').modal('show');

            },
            editModal(product) {
                $('#addProduct').modal('show');
                this.form.fill(product);
            },
            deleteProduct(id) {
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
        },
        mounted() {
            this.$store.dispatch('selectBrand');
            this.$store.dispatch('selectMetaKey')
        },
        computed: {
            brands() {
                return this.$store.state.brands;
            },
            meta_keys() {
                return this.$store.state.meta_keys
            }
        }

    }
</script>
