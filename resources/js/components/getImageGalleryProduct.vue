<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4> Images Gallery</h4>
                    <div class="card-header-form">
                    </div>
                </div>
                <div class="card-body ">
                    <!--                        <div class="gallery gallery-md">-->
                    <!--                            <div class="gallery-item d-flex ">-->
                    <figure class="figure position-relative" v-for="(srcViewImage,index) in srcViewImages" :key="index">
                        <img :src="srcViewImage.image" class="figure-img rounded mr-4" style="width:300px;height:200px;"
                             :alt="srcViewImage.alt">
                        <figcaption class="figure-caption">{{ srcViewImage.alt }}</figcaption>
                        <div class="  ">
                            <button class="btn btn-sm position-absolute rahDelete" @click="onDelete(srcViewImage.id)">
                                <i class="fas fa-minus-square text-primary" style="font-size: 20px;"></i>
                            </button>
                        </div>
                    </figure>
                    <!--                            </div>-->
                    <!--                        </div>-->
                </div>
                <div class="card-footer">
                    <button class="btn btn-sm btn-primary" type="button" @click="viewImages()">
                        <i class="fas fa-sync-alt mr-1" style="font-size: 14px;"></i> Refresh View Product images
                    </button>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4> new image entry in gallery</h4>
                    <div class="card-header-form">

                    </div>
                </div>
                <div class="card-body">
                    <div class="row ">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="imageName"> Image Name</label>
                                <input type="text" class="form-control " :class="[onInvalidAlt ? 'is-invalid' : '']"
                                       name="alt"
                                       id="imageName"
                                       @input="onInvalidAlt=false"
                                       v-model="alt"
                                >
                                <div class="invalid-feedback">Oh no! Name is Required.</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Upload index image</label>
                                <div class="input-group">
                                    <input type="text" id="image_label" class="form-control " disabled
                                           name="imageUrl"
                                           required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary text-white " type="button"
                                                id="button-image">
                                            <i class="fas fa-image"></i> Select Image
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <label>Actions</label>
                            <div class="form-group">
                                <button class="btn btn-sm btn-warning" @click="onSubmit">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "getImageGalleryProduct",
    props: {
        productId: Number,
    },
    data() {
        return {
            image: '',
            alt: '',
            srcViewImages: [],
            onInvalidAlt: false,
            // onInvalidUrl: false,
        }
    },

    mounted() {
        axios.get("/admin/product/"+this.productId)
            .then(res => this.srcViewImages = res.data)
            .catch(resp => alert("Could not load Images" + resp));
    },
    created() {
        let fileManager = document.createElement('script');
        fileManager.setAttribute('src', '../../../vendor/file-manager/js/file-manager.js');
        document.head.appendChild(fileManager);
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById('button-image').addEventListener('click', (event) => {
                event.preventDefault();
                window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
            });
        });
    },
    methods: {
        viewImages() {
            axios.get('/admin/product/' + this.productId)
                .then(resp => this.srcViewImages = resp.data)
                .catch(resp => alert("Could not load Images" + resp));
        },
        onSubmit() {
            this.image = document.getElementById('image_label').value;
            if (this.image && this.alt) {
                axios.post('/admin/product/' + this.productId + '/gallery', {
                    image: this.image,
                    alt: this.alt,
                }).then(res => this.srcViewImages = res.data)
                    .catch(resp => alert("Could not load New Image" + resp))
            } else {
                // if (!this.image) this.onInvalidUrl = true;
                if (!this.alt) this.onInvalidAlt = true;
            }
        },
        onDelete(id) {
            axios.delete('/admin/product/' + this.productId + '/gallery/' + id)
                .then((res) => {
                    alert("file is with successfully deleted")
                    this.srcViewImages = res.data;
                }).catch(resp => alert("Could not Delete Image" + resp))
        }
    },
}
</script>

<style scoped lang="scss">
$red: #f66d9b;
$purple: #563d7c;
.rahDelete {
    content: '';
    top: -10px;
    left: -10px;
    background-color: rgba(255, 255, 255, .7) !important;
    border-radius: 10px;
    padding-top: 4px;
}

.rahDelete:hover {
    //background-color: $red !important;
    opacity: 1 !important;
}

//.rahImage{
//    cursor: auto !important;
//    opacity:1 !important;
//    margin-right: 20px !important;
//}
</style>
