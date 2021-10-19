<template>
    <div class="row">
        <div class="form-group col-12">
            <ValidationProvider ref="provider" rules="image|size:150" immediate
                                v-slot="{ errors, validate,invalid }">
                <label>Upload File Image</label>
                <input type="file" class="form-control" @change="handleFileChange"
                       :class="{'is-invalid': invalid }">
                <div class="text-muted text-small font-italic ">Added file size should not exceed 150 KB.
                </div>
                <div><img src="/image/waiting.gif" width="40" alt="" v-if="waiting"><small class="text-small text-success" v-if="success">User Avatar image successfully uploaded.</small></div>
                <div class="invalid-feedback">{{ errors[0] }}</div>
            </ValidationProvider>
        </div>
        <hr>
    </div>
</template>
<script>
export default {
    name: "uploadUserImage",
    props: ['userId'],
    data() {
        return {
            waiting: false,
            success:false,
        }
    },
    methods: {
        async handleFileChange(e) {
            const {valid} = await this.$refs.provider.validate(e);
            if (valid) {
                this.waiting=true;
                this.success=false;
                let formData = new FormData();
                formData.append('id', this.userId);
                formData.append('avatar', e.target.files[0]);
                axios.post('/profile/uploadImage', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then((res) => {
                        this.waiting=false;
                        this.success=true;
                        this.$emit('userAvatar', res.data)
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            }else{
               this.waiting=false;
               this.success=false;
            }
        },

    },
}
</script>

<style scoped>

</style>
