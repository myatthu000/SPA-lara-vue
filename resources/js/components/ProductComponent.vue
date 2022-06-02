<template>
    <div class="container my-5">

        <div class="row justify-content-end mb-3">

            <div class="col-4">
                <button class="btn btn-primary" @click="create">
                    <i class="fas fa-plus-circle me-1"></i>
                    Create
                </button>
            </div>

<!--            Search Start-->
            <div class="col-4">
                <form action="" @submit.prevent="views">
                    <div class="input-group mb-3">
                        <input type="search"
                               v-model="search"
                               class="form-control"
                               placeholder="Search">
                        <button class="btn btn-primary"
                                type="button"
                                id="button-addon2">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
<!--            Search End-->

        </div>
        <div class="row">

<!--            Create Start-->
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ isEdit ? "Edit" : "Create" }}</h4>
                    </div>
                    <div class="card-body">

                        <form action="" @submit.prevent=" isEdit ? update() : store() ">
<!--                            <alert-error :form="product" :message="message"></alert-error>-->
                            <div class="form-group mb-3">
                                <label for="name">Name: </label>
                                <input v-model="product.name" type="text" id="name"
                                       class="form-control">
<!--                                <has-error :form="product" field="name"></has-error>-->
                            </div>
                            <div class="form-group mb-3">
                                <label for="price">Price: </label>
                                <input v-model="product.price" type="number" id="price"
                                       class="form-control">
<!--                                <has-error :form="product" field="price"></has-error>-->
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>
                                Save
                            </button>
                        </form>

                    </div>
                </div>
            </div>
<!--            Create End-->



<!--            Table start-->
            <div class="col-8">
                <table class="table table-hover table-striped text-nowrap">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>

                    <tr v-for="product in products.data" :key="product.id">
                        <td>{{ product.id }}</td>
                        <td>{{ product.name }}</td>
                        <td>{{ product.price }}</td>
                        <td>
                            <button class="btn btn-success btn-sm" @click="edit(product)">
                                <i class="me-1 fas fa-edit"></i>
                                Edit
                            </button>
                            <button class="btn btn-danger btn-sm" @click="destroy(product.id)">
                                <i class="me-1 fas fa-trash-alt"></i>
                                Delete
                            </button>
                        </td>
                    </tr>

                    </tbody>
                </table>

                <pagination :data="products" @pagination-change-page="views"></pagination>
            </div>
<!--            Table end-->

<!--            Loading -->

<!--            Loading -->

        </div>
    </div>
</template>

<script>

    // import { Form,HasError,AlertError } from 'vform';


    export default {
        name: "ProductComponent",

        data() {
            return {

                fullPage: false,
                isEdit : false,
                search : '',
                products:{} ,
                product: {
                    name: '',
                    price: ''
                },
                message : "",
            }
        },

        methods: {
            searchProduct(){
                axios.get(`/api/product?search=${this.search}`)
                    .then(response => {
                        this.products = response.data;
                    }).catch(({ response })=>{
                    console.error(response)
                })
            },
            views(page=1) {
                this.$Progress.start()
                let loader = this.$loading.show();
                axios
                    .get(`/api/product?page=${page}&search=${this.search}`)
                    .then(response => {
                        this.products = response.data;
                        this.$Progress.finish();
                        loader.hide();
                    }).catch( error => {
                        this.$Progress.fail();
                        loader.hide();
                    })
            },
            create(){
                this.isEdit = false;
                this.product.id = "";
                this.product.name = "";
                this.product.price = "";
            },

            store(){
                // console.log(this.product)
                // this.product = {id:"" ,name: "",price: ""}

                axios.post("api/product/",this.product)
                    .then(response=>{
                        this.views();
                        this.product = {
                            id:'',
                            name: '',
                            price: ''
                        }
                        setTimeout(function () {
                            // Swal.fire({title : 'Deleted!',icon : 'success'});
                            Toast.fire({icon: 'success',title: 'Item added successfully'});
                        },500);

                    }).catch(error=>{this.message = error.response.data.message})
            },

            edit(product){
                this.isEdit = true;
                this.product.id = product.id;
                this.product.name = product.name;
                this.product.price = product.price;
            },

            update(){
                axios.put(`/api/product/${this.product.id}`,this.product)
                    .then(response=>{
                        this.views();
                        this.product = {
                            id:'',
                            name: '',
                            price: ''
                        }
                        setTimeout(function () {
                            // Swal.fire({title : 'Deleted!',icon : 'success'});
                            Toast.fire({icon: 'success',title: 'Edit Successfully'});
                        },500);
                    })
                    .catch(errors=>console.log(errors))
            },

            destroy(id) {

                Swal.fire({
                    title: 'Are you sure?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`/api/product/${id}`).then(response => {
                            this.views();
                            setTimeout(function () {
                                // Swal.fire({title : 'Deleted!',icon : 'success'});
                                Toast.fire({icon: 'success',title: 'Delete in successfully'});
                            },500);
                        });
                    }
                })

            }
        },

        created() {
            this.views();
        }
    }
</script>

<style>

    .pagination{
        margin-bottom: 0;
    }
</style>
