<template>
    <div class="row mb-5 mg-lg-0">
        <!--<div class="col-6 col-sm-4 col-lg-2 mb-3">-->
            <!--<div class="input-file-preview">-->
                <!--<img src="/images/temp/input-file-preview.jpg" width="203" height="111">-->
            <!--</div>-->
        <!--</div>-->
        <!--<div class="col-6 col-sm-4 col-lg-2">-->
            <!--<div class="input-file-preview">-->
                <!--<img src="/images/temp/input-file-preview.jpg" width="203" height="111">-->
            <!--</div>-->
        <!--</div>-->
        <!--<div class="col-6 col-sm-4 col-lg-2 mb-4">-->
            <!--<div class="input-file-preview"></div>-->
        <!--</div>-->
        <!--<div class="col-6 col-sm-4 col-lg-2 mb-4">-->
            <!--<div class="input-file-preview"></div>-->
        <!--</div>-->
        <!--<div class="col-6 col-sm-4 col-lg-2 mb-4">-->
            <!--<div class="input-file-preview"></div>-->
        <!--</div>-->
        <div class="col-6 col-sm-4 col-lg-2 mb-4" v-for="(image, index) in images" :key="index">
            <div class="input-file-preview" @click="setActive(index)" :class="{'active-image' : index === activeIndex}">
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
                    return []
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
                // this.activeIndex = index
            }
        },
        watch: {
            'username' : ['changeError'],
            'password' : ['changeError'],
            'password_confirm' : ['changeError'],
        }

    }
</script>
