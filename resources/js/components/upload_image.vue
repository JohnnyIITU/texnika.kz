<template>
    <div class="row mb-5 mg-lg-0">
        <div class="col-6 col-sm-4 col-lg-2 mb-4" v-for="(image, index) in images" :key="index">
            <div class="input-file-preview image-container" @click="setActive(index)" :class="{'active-image' : index === activeIndex}">
                <button type="button"
                        class="delete-image-button"
                        @click="deleteImage(index)">
                    <i class="fas fa-times"></i>
                </button>
                <div class="layer"></div>
                <img :src="image"/>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-2 mb-4">
            <div class="input-file">
                <input type="file" multiple name="myImage" accept="image/x-png,image/gif,image/jpeg" @change="onInputChange">
                <span>Select files</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "upload_image",
        data() {
            return {
                type: '',
                isCreated: false,
            }
        },
        props: {
            files: {
                type: Array,
                default () {
                    return []
                }
            },
            images: {
                type: Array,
                default () {
                    return []
                }
            },
            activeIndex : {
                type: Number,
                default() {
                    return 0;
                }
            },
        },
        methods: {
            onInputChange: function (e) {
                const files = e.target.files;

                Array.from(files).forEach(file => this.addImage(file));
            },
            addImage: function (file) {
                if (!file.type.match('image.*')) {
                    this.$toastr.e(`${file.name} is not an image`);
                    return;
                }
                this.files.push(file);
                const img = new Image(),
                reader = new FileReader();
                reader.onload = (e) => this.images.push(e.target.result);
                reader.readAsDataURL(file);
            },
            upload: function(){
                // this.$emit('images', this.images);
                // this.$emit('files', this.files);
            },
            setActive (index) {
                this.$parent.activeIndex = index;
            },
            deleteImage (index) {
                this.$parent.images.splice(index,1);
                this.$parent.activeIndex = 0;
            }
        },
        watch: {
            'username' : ['changeError'],
            'password' : ['changeError'],
            'password_confirm' : ['changeError'],
        }

    }
</script>

<style scoped>
    .image-container {
        position: relative;
    }

    .layer {
        position: absolute;
        z-index: 1;
        width: 100%;
        height: 100%;
        transition: 0.4s ease-in-out;
    }

    .delete-image-button {
        display: none;
        right: 0;
        position: absolute;
        z-index: 2;
        border: none;
        background-color: #000;
        outline: none;
        transition: 0.4s ease-in-out;
    }

    .delete-image-button i {
        color: #FFF;
    }

    .image-container:hover .layer {
        transition: 0.4s ease;
        background-color: rgba(0, 0, 0, 0.8);
    }

    .image-container:hover .delete-image-button {
        cursor: pointer;
        display: block;
    }

    .button-delete {
        cursor: pointer;
        outline: none;
        transition: 0.4s ease;
    }

    .button-delete:hover {
        color: red;
    }
</style>
