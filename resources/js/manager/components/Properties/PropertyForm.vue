<template>
    <div class="mt-2">
        <template v-if="isLoading">
            <span class="fa fa-spinner fa-spin"></span>
        </template>
        <template v-else>
            <div class="card">
                <div class="card-header bg-gradient-secondary">
                    <h3 class="card-title"><span class="text-bold">*</span> means required</h3>
                    <div class="card-tools">
                        <router-link v-if="$route.params.id" :to="{name: 'manager-properties-details', params: {id: $route.params.id}}" class="btn btn-info btn-sm mr-2"><i
                            class="fa fa-cog"></i>
                            Property Details
                        </router-link>
                        <router-link :to="{name: 'manager-properties-list'}" class="btn btn-dark btn-sm"><i
                            class="fa fa-backward"></i>
                            Back To List
                        </router-link>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name<span class="text-red">*</span></label>
                                <input type="text" v-model="property.name"
                                       class="form-control"
                                       placeholder="Name of this property" required>
                            </div>
                            <div class="form-group">
                                <label>Country<span class="text-red">*</span></label>
                                <select v-model="property.country" class="form-control select2" style="width: 100%;">
                                    <option value="">The country this property is located in</option>
                                    <option v-for="country in countries" :value="country.name">
                                        {{ country.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>City<span class="text-red">*</span></label>
                                <select v-model="property.city" class="form-control select2" style="width: 100%;">
                                    <option value="">In which city?</option>
                                    <option v-for="city in cities" :value="city.name">
                                        {{ city.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Street<span class="text-red">*</span></label>
                                <input type="text" v-model="property.street"
                                       class="form-control"
                                       placeholder="What about the street?" required>
                            </div>
                            <div class="form-group">
                                <label>Zip</label>
                                <input type="text" v-model="property.zip"
                                       class="form-control"
                                       placeholder="The zip code or landmark">
                            </div>
                            <div class="form-group">
                                <label>Featured Photo</label>
                                <input type="file" @change="handleFileChange" class="form-control pt-3 pb-5"
                                       accept="image/*">
                                <div class="mt-2" v-if="imageUrl">
                                    <img :src="imageUrl" class="img-thumbnail" width="200" height="200">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description</label>
                                <SummernoteEditor
                                    placeholder="Some eye catching description of this property"
                                    v-model="property.description"
                                />
                            </div>
                            <div class="form-group">
                                <h6 class="text-bold">Amenities (select all that apply)</h6>
                                <div class="d-flex flex-wrap justify-content-between">
                                    <template v-for="amenity in amenities">
                                        <div class="form-check-inline w-40">
                                            <input type="checkbox" v-model="property.amenities" class="form-check-input"
                                                   :value="amenity.id" multiple>
                                            <div class="form-check-label">{{ amenity.name }}</div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button"
                            @click.prevent="saveProperty()"
                            :disabled="formInvalid"
                            class="btn btn-warning btn-block">
                        Save <i class="far fa-save"></i>
                    </button>
                </div>
            </div>
        </template>
    </div>
</template>

<script lang="ts">
import {computed, defineComponent, reactive, ref} from "vue";
import {useStore} from "vuex";
import {useRoute, useRouter} from "vue-router";
import {Property} from "@/manager/store/property/types";

export default defineComponent({
    name: "PropertyForm",
    components: {SummernoteEditor: require("@/manager/components/Shared/SummernoteEditor.vue").default},
    setup() {
        const store = useStore();
        const router = useRouter();
        const route = useRoute();
        const isSending = ref(false);
        const isLoading = computed(() => !!store.state.propertyModule.isLoading);
        const property = reactive(new Property());
        const imageUrl = ref('');
        const amenities = computed(() => store.state.formOptions.amenities);
        const countries = computed(() => store.state.formOptions.countries);
        const cities = computed(() => store.state.formOptions.cities);
        const formInvalid = computed(() => isSending.value || !property.name || !property.country || !property.city || !property.street);

        const handleFileChange = (event: any) => {
            const file = event.target.files[0];
            imageUrl.value = URL.createObjectURL(file);
            property.photo = file;
        };

        const saveProperty = async () => {
            try {
                isSending.value = true;
                let response = await store.dispatch("propertyModule/saveProperty", property);
                isSending.value = false;
                await store.dispatch("SET_SNACKBAR", {title: response, icon: 'success'});
                await router.push({name: 'manager-properties-list'});
            } catch (error) {
                isSending.value = false;
                await store.dispatch("SET_SNACKBAR", {title: "Response Status", html: error, icon: 'error'});
            }
        };

        const getProperty = async () => {
            try {
                if(!route.params.id){
                    return;
                }
                let response = await store.dispatch("propertyModule/getPropertyForUpdate", {id: route.params.id || null});
                property.id = response.id;
                property.name = response.name;
                property.description = response.description;
                property.country = response.country;
                property.city = response.city;
                property.street = response.street;
                property.zip = response.zip;
                property.amenities = response.amenities;
            } catch (error) {
                await store.dispatch("SET_SNACKBAR", {title: error, icon: 'error'});
                // await router.push({name: 'manager-properties-list'});
            }
        };

        getProperty();
        store.dispatch("GET_FORM_OPTIONS", 'countries,cities,amenities');

        return {
            isSending,
            property,
            amenities,
            countries,
            cities,
            imageUrl,
            formInvalid,
            isLoading,
            handleFileChange,
            saveProperty,
        }
    }
});
</script>

<style lang="scss" scoped>

</style>
