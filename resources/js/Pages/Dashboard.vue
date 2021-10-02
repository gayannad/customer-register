<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Customer Create
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg">
                    <form @submit.prevent="store">
                        <div class="shadow">
                            <div class="flex flex-wrap pb-2">
                                <div class="w-1/3 ml-auto">
                                    <label class="block font-bold md:text-right md:pr-2">
                                        Name
                                    </label>
                                </div>
                                <div class="w-1/3 mr-auto">
                                    <input class="border-2 border-gray-200 rounded w-full" v-model="form.name" type="text">
                                    <div v-if="form.errors.name" class="text-red-700">{{ form.errors.name }}</div>
                                </div>
                            </div>

                            <div class="flex flex-wrap pb-2">
                                <div class="w-1/3 ml-auto">
                                    <label class="block font-bold md:text-right md:pr-2">
                                        NIC
                                    </label>
                                </div>
                                <div class="w-1/3 mr-auto ">
                                    <input class="border-2 border-gray-200 rounded w-full" v-model="form.nic" type="text">
                                    <div v-if="form.errors.nic" class="text-red-700">{{ form.errors.nic }}</div>
                                </div>
                            </div>

                            <div class="flex flex-wrap pb-2">
                                <div class="w-1/3 ml-auto  ">
                                    <label class="block font-bold md:text-right md:pr-2">
                                        Address
                                    </label>
                                </div>
                                <div class="w-1/3 mr-auto ">
                                    <input class="border-2 border-gray-200 rounded w-full" v-model="form.address" type="text">
                                    <div v-if="form.errors.address" class="text-red-700">{{ form.errors.address }}</div>
                                </div>
                            </div>

                            <div class="flex flex-wrap pb-2">
                                <div class="w-1/3 ml-auto  ">
                                    <label class="block font-bold md:text-right md:pr-2">
                                        Telephone
                                    </label>
                                </div>
                                <div class="w-1/3 mr-auto ">
                                    <div
                                        v-for="(input, index) in phoneNumbers"
                                        :key="`phoneInput-${index}`"
                                        class="input wrapper flex items-center"
                                    >
                                        <input
                                            v-model="form.phone"
                                            type="text"
                                            class="h-10 rounded-lg outline-none p-2 pb-2"
                                            placeholder=" Enter Phone Number"
                                        />
                                        <!--          Add Svg Icon-->
                                        <svg

                                            @click="addField(input, phoneNumbers)"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            width="24"
                                            height="24"
                                            class="ml-2 cursor-pointer"
                                        >
                                            <path fill="none" d="M0 0h24v24H0z"/>
                                            <path
                                                fill="green"
                                                d="M11 11V7h2v4h4v2h-4v4h-2v-4H7v-2h4zm1 11C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"
                                            />
                                        </svg>

                                        <!--          Remove Svg Icon-->
                                        <svg
                                            v-show="phoneNumbers.length > 1"
                                            @click="removeField(index, phoneNumbers)"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            width="24"
                                            height="24"
                                            class="ml-2 cursor-pointer"
                                        >
                                            <path fill="none" d="M0 0h24v24H0z"/>
                                            <path
                                                fill="#EC4899"
                                                d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm0-9.414l2.828-2.829 1.415 1.415L13.414 12l2.829 2.828-1.415 1.415L12 13.414l-2.828 2.829-1.415-1.415L10.586 12 7.757 9.172l1.415-1.415L12 10.586z"
                                            />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit"
                                        class="py-2 px-4 float-left border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600">
                                    Cancel
                                </button>
                                <button type="submit"
                                        class="py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600">
                                    Save
                                </button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </app-layout>
</template>

<script>
    import {defineComponent} from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Input from '@/Jetstream/Input'

    export default defineComponent({
        name: "AddRemove",
        components: {
            AppLayout,
            Input
        },
        data() {
            return {
                phoneNumbers: [{phone: ""}],
                form: this.$inertia.form({
                    name: "",
                    nic: "",
                    address: "",
                    phone: [],
                })
            }
        },
        methods: {
            store() {
                this.form.post(this.route('customers.store'))
            },
            addField(value, fieldType) {
                fieldType.push({value: ""});
            },
            removeField(index, fieldType) {
                //type.splice(index, 1);
                fieldType.splice(index, 1);
            }
        }
    })
</script>
