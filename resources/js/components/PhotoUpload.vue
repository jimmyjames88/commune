<template>
    <div class="card">
        <div class="card-body">
            <div class="card" v-show="showPreview">
                    <div class="preview-area" ref="preview" @click="removePhoto">
                        <i class="fa fa-times remove-preview"></i>
                    </div>
            </div>
            <input :name="name" type="file" accept="image/*" ref="file" class="form-control" @change="fileChange" />
        </div>
    </div>
</template>

<style lang="scss">
    .preview-area {
        width: 100%;
        padding-top:88.75%;
        background-position: center center;
        background-size: cover;
        background-repeat: no-repeat;
        position: relative;

        .remove-preview {
            cursor: pointer;
            right: 10px;
            top: 6px;
            position: absolute;
            color: rgba(255, 255, 255, 0.7);
            transition: all 0.2s ease;
            font-size: 1.5rem;
            text-shadow: rgba(0, 0, 0, 0.4) 2px 2px 2px;

            &:hover {
                color: rgba(255, 255, 255, 1);
            }
        }
    }
</style>

<script>
    export default {
        props: ['name', 'photo'],
        data() {
            return {
                showPreview: false
            }
        },
        mounted() {
            if(this.photo) {
                this.setPreview(this.photo);
            }
        },
        methods: {
            removePhoto() {
                this.$refs.file.value = '';
                this.showPreview = false;
            },
            fileChange(e) {
                var file = e.target.files[0];
                this.setPreview(file);
            },
            setPreview(file) {

                // set initial preview from photo prop
                if(typeof file == 'string') {
                    this.$refs.preview.style.backgroundImage = 'url(' + this.photo + ')';
                    this.showPreview = true;
                    return;
                }

                // set preview for chosen file
                var reader = new FileReader();
                var self = this;
                reader.onload = function(e) {
                    self.$refs.preview.style.backgroundImage = 'url(' + e.target.result + ')';
                    self.showPreview = true;
                }
                reader.readAsDataURL(file);
            }
        }
    }
</script>
