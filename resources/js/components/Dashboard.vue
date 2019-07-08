<template>
    <div class="container">
        <div class="row">
            <div class=" col-md-4 text-center col-md-offset-1">
                <div class="form mb-2 mt2">
                    <div class="form-group mb-5" v-for="(row,index) in rows">
                        <div class="card">
                            <div class="card-body">
                                    <label for="title">Title</label>
                                    <input type="text" name="title"
                                           class="form-control" id="title"
                                           placeholder="Add Row"
                                           v-model="row.title">
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success float-left"
                                         >
                                            Add
                                        </button>
                                        <button type="submit" class="btn btn-primary float-right"
                                                @click.prevent="removeRow(index)">Remove Row
                                        </button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-warning mb-2 float-left"
                        @click="addNewRow">Add New Row</button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{countProduct}}</h3>
                        <p>Total Products</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>

                        <p>Bounce Rate</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{users.length}}</h3>

                        <p>Total User</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <router-link
                            to="/user"
                            class="small-box-footer"

                    >
                        More info
                        <i class="fa fa-arrow-circle-right"></i>
                    </router-link>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{countBlog}}</h3>

                        <p>Blog</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <router-link to="blog"
                                 class="small-box-footer">More info
                        <i class="fa fa-arrow-circle-right"></i>
                    </router-link>
                </div>
            </div>
            <!-- ./col -->
        </div>

    </div>

</template>
<script>
    export default {
        name: "Dashboard",
        data() {
            return {
                rows: [
                    {
                        title: '',
                    }
                ],
                count: 0,
            }

        },
        mounted() {
            this.$store.dispatch('fetchUser');
            this.$store.dispatch('countBlog');
            this.$store.dispatch('countProduct');
        },
        computed: {

            users() {
                return this.$store.state.users;
            },
            countBlog() {
                return this.$store.state.countBlog;
            },
            countProduct() {
                return this.$store.state.countProduct;
            }


        },
        methods: {
            addNewRow() {
                this.rows.push({
                    title: '',
                })
            },
            removeRow(index) {
                this.rows.splice(index, 1);
            },


        }


    }
</script>
