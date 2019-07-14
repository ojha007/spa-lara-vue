<template>

    <div>
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h5>User Detail Table</h5>
                </div>
                <div class="card-tools float-right">
                    <button class="btn btn-success" @click.prevent="newModal"

                    >
                        <i class="fa fa-user-plus"></i>
                        Add User
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
                                        <i class="fa fa-mail-bulk"></i> Email
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending" style="width: 262.6px;">
                                        <i class="fa fa-user-alt"></i>
                                        Name
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 233px;">
                                        <i class="fa fa-users"></i>
                                        Role
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 233px;">
                                        <i class="fa fa-check-circle"></i>
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
                                    v-for="user in users"
                                    :key="user.id"
                                >
                                    <td>
                                        {{user.email}}
                                    </td>
                                    <td class="sorting_1">{{user.name}}</td>
                                    <td>{{user.role.display_name}}</td>
                                    <td>{{user.status}}</td>
                                    <td>
                                        <div class="btn-group">

                                            <i class="fa fa-edit green" title="Edit"
                                               @click.prevent="editModal(user)"></i>
                                            &nbsp;&nbsp;&nbsp;
                                            <i class="fa fa-trash red" title="Delete"
                                               @click.prevent="deleteUser(user.id)"></i>

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

        <div class="modal fade" id="addUserModel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-user-plus"></i>
                            {{ editMode ? 'Update': 'Add' }} User
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent=" editMode ? updateUser() : addUser()">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <alert-error :form="form" message="Your changes have been saved!"></alert-error>
                                <div class="form-group">
                                    <i class="fa fa-mail-bulk"></i>
                                    <label for="email">Email</label>
                                    <input type="email"
                                           name="email" id="email"
                                           required
                                           v-model="form.email"
                                           class="form-control"
                                           :class="{ 'is-invalid': form.errors.get('email') }"
                                           placeholder="Enter Email Here ?">
                                    <has-error :form="form" field="email"></has-error>
                                </div>

                                <div class="form-group">
                                    <i class="fa fa-user"></i>
                                    <label for="name">Name</label>
                                    <input type="text"
                                           v-model="form.name"
                                           required
                                           name="name" id="name"
                                           placeholder="Enter Name Here ?"
                                           class="form-control"
                                           :class="{ 'is-invalid': form.errors.has('name') }">
                                    <has-error :form="form" field="username"></has-error>
                                </div>

                                <div class="form-group">
                                    <i class="fa fa-users"></i>
                                    <label for="role">Select Role</label>
                                    <select name="role_id" id="role"
                                            required
                                            v-model="form.role_id"
                                            class="form-control"
                                            :class="{ 'is-invalid': form.errors.has('role_id') }">

                                        <option :value="role.id"
                                                :key="role.id"
                                                v-for="role in roles">

                                            {{role.display_name}}
                                        </option>

                                    </select>
                                    <has-error :form="form" field="role"></has-error>
                                </div>

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
                                    <i class="fa fa-lock"></i>
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control"
                                           required name="password" id="password"
                                           placeholder="Enter Password Here?"
                                           v-model="form.password"
                                           :class="{ 'is-invalid': form.errors.get('password') }">
                                    <has-error :form="form" field="password"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <i class="fa fa-close"></i> Close
                            </button>
                            <button type="submit" :disabled="form.busy" class="btn btn-success">
                                <i class="fa fa-user-plus"></i>
                                {{editMode ? 'Update': 'Add' }}

                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

</template>


<script>
    import Vue from 'vue';
    import axios from 'axios';
    import Form from 'vform';
    import {HasError, AlertError} from 'vform';
    import PacmanLoader from 'vue-spinner/src/PacmanLoader';

    Vue.component(HasError.name, HasError);
    Vue.component(AlertError.name, AlertError);

    export default {
        name: 'User',
        components: {
            HasError,
            PacmanLoader
        },
        data() {
            return {
                editMode: true,
                loading: true,
                color: 'grey',
                size: '15px',
                model: true,
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    role_id: '',
                    status: '',
                    role: {
                        display_name: '',
                    }
                })
            }
        },
        methods: {
            newModal() {
                this.editMode = false;
                this.form.reset();
                $('#addUserModel').modal('show');
            },
            addUser() {
                this.editMode = false;
                this.$Progress.start();
                axios.post('api/v1/user', this.form)
                    .then(res => {
                        let payload = {
                            email: res.data.email,
                            name: res.data.name,
                            status: res.data.status,
                            role_id: res.data.role_id,
                            role: {
                                display_name: res.data.role.display_name,
                            }
                        };
                        this.$store.commit("ADD_USER", payload);
                        $('#addUserModel').modal('hide');
                        $('#addUserModel').reset();
                        this.$Progress.finish();
                        Toast.fire({
                            type: 'success',
                            title: 'User Created successfully'
                        })
                    })
                    .catch(err => {
                        Toast.fire({
                            type: 'error',
                            title: 'Something went wrong'
                        });
                        this.$Progress.fail();
                    })
            },
            deleteUser(id) {
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
                        axios.delete('/api/v1/user/' + id).then(res => {
                            this.$Progress.start();
                            let index = this.users.findIndex(item => item.id === id);
                            this.users.splice(index, 1);
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
            updateUser() {
                this.$Progress.start();
                this.form.put('api/v1/user/' + this.form.id, this.form)
                    .then(res => {
                        $('#addUserModel').modal('hide');

                        console.log(this.form);
                         // this.users.replace(user => {
                         //     user.indexOf(user.id===this.form.id,this.form)
                         // });
                        Toast.fire({
                            type: 'success',
                            title: 'User Created successfully'
                        });
                    }).catch(err => {
                    this.$Progress.fail();

                })
            },
            editModal(user) {
                this.editMode = true;
                $('#addUserModel').modal('show');
                this.form.fill(user);
            }


        },

        mounted() {
            this.$store.dispatch("fetchUser");
            this.$store.dispatch("fetchUserRole");
        },

        computed: {
            users() {
                this.loading = false;
                return this.$store.state.users;
            },
            roles() {
                return this.$store.state.roles;
            }
        }
    }
</script>
