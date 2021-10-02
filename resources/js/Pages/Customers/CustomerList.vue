<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Customer Create
            </h2>
        </template>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-4">
                    <label for="">Search</label>
                    <input type="text" v-model="search" @keyup="search" class="ml-2 px-2 py-1  rounded border">
                </div>
                <table class="w-full">
                    <tr class="bg-gray-900 text-white">
                        <th class="px-2 py-1 text-sm font-bold text-left">ID</th>
                        <th class="px-2 py-1 text-sm font-bold text-left">Name</th>
                        <th class="px-2 py-1 text-sm font-bold text-left">NIC</th>
                    </tr>
                    <tr v-for="customer in customers.data">
                        <td class="px-2 py-1 text-sm text-left">{{customer.id}}</td>
                        <td class="px-2 py-1 text-sm text-left">{{customer.name}}</td>
                        <td class="px-2 py-1 text-sm text-left">{{customer.nic}}</td>
                    </tr>
                </table>

                <!--                <pagination class="mt-6" :links="customers.links" />-->
            </div>
        </div>
    </app-layout>
</template>

<script>
    import {defineComponent} from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Pagination from "@/Components/Pagination";

    export default defineComponent({
        components: {
            AppLayout,
            Pagination
        },

        data() {
            return {
                search: '',
                customers:{}
            }
        },

        methods: {

            fetchingAllUnit() {
                axios.get("api/customers/list").then( data => (this.customers = data.data));
            },
        },
        created(){

            this.fetchingAllUnit();

        },
    })
</script>


