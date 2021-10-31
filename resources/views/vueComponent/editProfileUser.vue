<template>
    <div>
        <ValidationObserver v-slot="{pristine,invalid}">
            <form class="needs-validation" @submit.prevent="submitUser">
                <div class="row">
                    <div class="form-group col-12">
                        <ValidationProvider name="name" rules="required|alpha_spaces"
                                            v-slot="{ errors ,invalid,}">
                            <label class="" for="name">Name:</label>
                            <input type="text" class="form-control" v-model="userData.name" name="name"
                                   :class="{'is-invalid': invalid }"
                            >
                            <div class="invalid-feedback">{{ errors[0] }}</div>
                        </ValidationProvider>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-12">
                        <ValidationProvider name="email" rules="required|email" v-slot="{ errors ,invalid,}">
                            <label>Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-at"></i>
                                    </div>
                                </div>
                                <input id="email" type="text" name="email" v-model="userData.email"
                                       autocomplete="email" class="form-control "
                                       :class="{'is-invalid': invalid }"
                                >
                                <div class="invalid-feedback">{{ errors[0] }}</div>
                                <div class="EmailRepeat" v-if="isEmail">Email has already been used by another user!!
                                </div>
                            </div>
                        </ValidationProvider>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <ValidationProvider name="phone_number" rules="digits:11" v-slot="{ errors ,invalid,}">
                            <label>Mobile:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-mobile-alt"></i>
                                    </div>
                                </div>
                                <input type="tel" class="form-control "
                                       v-model="userData.phone_number"
                                       name="phone_number"
                                       :class="{'is-invalid': invalid }"
                                >
                                <div class="invalid-feedback">{{ errors[0] }}</div>
                            </div>
                            <div class="text-muted text-small font-italic">Add exactly 11 numbers</div>
                        </ValidationProvider>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <ValidationProvider rules="confirmed:confirmation" v-slot="{ errors , invalid}">
                            <label>New Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>
                                <input type="password" name="password" id="password"
                                       v-model="userData.password"
                                       class="form-control"
                                       :class="{'is-invalid': invalid }"
                                >
                                <div class="invalid-feedback">{{ errors[0] }}</div>
                            </div>
                        </ValidationProvider>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <ValidationProvider v-slot="{ errors, invalid }" vid="confirmation">
                            <label>Confirm New Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>
                                <input id="password-confirm" type="password" name="password_confirmation"
                                       class="form-control"
                                       :class="{'is-invalid': invalid }"
                                       v-model="confirmation"
                                >
                                <div class="invalid-feedback">{{ errors[0] }}</div>
                            </div>
                        </ValidationProvider>
                    </div>
                </div>
                <div class="d-flex justify-content-between ">
                    <div>
                        <img src="/image/success.gif" width="30" alt="" v-if="success"><small
                        class="text-small text-success" v-if="success">User Profile successfully edited.</small>
                    </div>
                    <button type="submit" :disabled=" invalid || pristine " class="btn btn-primary">
                        Save Changes
                    </button>

                </div>
            </form>
        </ValidationObserver>
    </div>
</template>
<script>

export default {
    name: "editProfileUser",
    props: {
        'userEdit': Object,
    },
    data() {
        return {
            userData: this.userEdit,
            avatar: '',
            isEmail: false,
            email: '',
            confirmation: '',
            success: false,
        }
    },
    watch: {
        success:  function () {
            let vm = this;
            setTimeout(  ()=> {
                vm.success = false;
            }, 3000)
        }
    },
    methods: {
        submitUser() {
            const senDataUser = {
                id: this.userData.id,
                name: this.userData.name,
                email: this.userData.email,
                phone_number: this.userData.phone_number,
                password: this.userData.password,
            };
            axios.post('/profile', senDataUser)
                .then((res) => {
                    if (res.data === 0) {
                        console.log(res.data);
                        this.isEmail = true;
                    } else {
                        this.isEmail = false;
                        this.success = true;
                        // alert('User Profile successfully edited.');
                        this.$emit('userEditTo', res.data)
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        }
    },
    mounted() {
    },
}
</script>

<style scoped>
.EmailRepeat {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 80%;
    color: #f66d9b;
}
</style>
