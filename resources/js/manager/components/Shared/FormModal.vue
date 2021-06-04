<template>
    <div class="modal fade show"
         data-backdrop="static"
         data-keyboard="false"
         tabindex="-1"
         aria-modal="true"
         role="dialog"
         style="display: block;">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" v-bind:class="(!!size) ? 'modal-' + size : 'modal-lg'">
            <div class="modal-content">
                <form autocomplete="off" @submit.prevent="$emit('submitted')">
                    <div class="modal-header bg-gradient-secondary">
                        <h5 class="modal-title text-bold">
                            <slot name="header"></slot>
                        </h5>
                        <button type="button" @click="$emit('closed')" class="close text-white-50">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <slot name="body"></slot>
                    </div>
                    <div class="modal-footer">
                        <slot name="footer"></slot>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent} from "vue";

export default defineComponent({
    name: "FormModal",
    props: ['size'],
    emits: ['submitted','closed'],
});
</script>

<style lang="scss" scoped>
    .modal-dialog-scrollable .modal-content {
        border: 0;
        border-radius: 0;
        overflow-y: auto;
    }
</style>
