<template>
    <textarea class="form-control"
              ref="summernoteEditor"
              :placeholder="placeholder"
              :value="modelValue"
              style="width: 100%; font-size: 14px;">
    </textarea>
</template>

<script>
import {defineComponent} from "vue";

export default defineComponent({
    name: "SummernoteEditor",
    props: {
        placeholder: String,
        modelValue: {
            type: String,
            default: "",
        },
        height: {
            type: Number,
            required: false,
            default: 160
        },
    },
    data() {
        return {
            summernoteEditor: null,
            isChanging: false,
        }
    },
    mounted() {
        this.summernoteEditor = jQuery(this.$refs.summernoteEditor);
        //Init the Awesome Summernote Text Editor
        this.summernoteEditor.summernote({
            height: this.height,
            callbacks: {
                onChange: (contents) => {
                    console.log(contents);
                    if (!this.isChanging) {
                        this.isChanging = true;
                        this.$emit('update:modelValue', contents);
                        this.$nextTick(() => {
                            this.isChanging = false;
                        });
                    }
                },
                onInit: () => {
                    let content = this.modelValue || "";
                    this.summernoteEditor.summernote("code", content);
                },
            }
        });
    },
    watch: {
        "modelValue"(newVal, oldVal){
            if (!this.isChanging) {
                this.isChanging = true;
                let content = newVal || "";
                this.summernoteEditor.summernote("code", content);
                this.isChanging = false;
            }
        },
    },
});
</script>

<style lang="scss" scoped>

</style>
