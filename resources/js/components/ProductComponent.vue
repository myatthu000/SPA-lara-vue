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
                        <form action="" @submit.prevent="isEdit ? update() : store() ">
                            <div class="form-group mb-3">
                                <label for="name">Name: </label>
                                <input required v-model="product.name" type="text" id="name" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="price">Price: </label>
                                <input required v-model="product.price" type="number" id="price" class="form-control">
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


        </div>
    </div>
</template>

<script>

    export default {

        name: "ProductComponent",

        data() {
            return {
                isEdit : false,
                search : '',
                pagination:{
                  current_page : 1,
                },
                page : 1 ,
                products:{} ,
                product: {
                    name: '',
                    price: ''
                }
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
            views(page) {
                axios.get(`/api/product?page=${page}&search=${this.search}`)
                .then(response => {
                    this.products = response.data;
                }).catch(({ response })=>{
                        console.error(response)
                })
            },
            create(){
                this.isEdit = false;
                this.product.id = "";
                this.product.name = "";
                this.product.price = "";
            },
            store(){
                axios.post("api/product",this.product)
                .then(response=>{
                    this.views();
                    this.product = {
                        id:'',
                        name: '',
                        price: ''
                    }
                })
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
                    })
                    .catch(errors=>console.log(errors))
            },
            destroy(id){
                if (!confirm("Are you sure to delete?")){
                    return ;
                }
                axios.delete(`/api/product/${id}`)
                .then(response=>{
                    this.views();
                })
                .catch(errors=>console.log(errors))
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
