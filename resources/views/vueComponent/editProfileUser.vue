<template>
    <div class="col-12 col-md-12 col-lg-7">
        <div class="card">
            <ValidationObserver v-slot="{ pristine , invalid }">
                <form class="needs-validation" @submit.prevent="submitUser" enctype="multipart/form-data">
                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <label>File</label>
                                <input type="file" class="form-control" name="avatar">
                            </div>
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
                                        <div class="invalid-feedback">Email has already been used by another user!!
                                        </div>
                                        <!--                                    <div class="unrealEmail" v-if="unrealEmail">The email address is Unreal!!</div>-->
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
                                </ValidationProvider>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>New Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </div>
                                    </div>
                                    <input type="password" name="password" id="password" autocomplete="new-password"
                                           v-model="userData.password"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Confirm New Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </div>
                                    </div>
                                    <input id="password-confirm" type="password" name="password_confirmation"
                                           autocomplete="new-password" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" :disabled="pristine || invalid" class="btn btn-primary">Save Changes
                        </button>
                    </div>
                </form>
            </ValidationObserver>
        </div>
    </div>

</template>

<script>
import {ValidationObserver, ValidationProvider, extend} from 'vee-validate';
import * as rules from 'vee-validate/dist/rules';

Object.keys(rules).forEach(rule => {
    extend(rule, rules[rule]);
});
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
            // unrealEmail:false,
        }
    },
    components: {
        ValidationProvider, ValidationObserver
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
                    // if(res.data === 'unreal'){
                    //     this.unrealEmail= true;
                    //     console.log(res.data);
                    // }
                    if (res.data === 0) {
                        console.log(res.data);
                        this.isEmail = true;
                    } else {
                        this.isEmail = false;
                        console.log('ok');
                        this.$emit('userEditTo', res.data)
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
            // console.log(senDataUser);
        }
    },
    mounted() {
        //     axios.get("/profile/" + this.userId)
        //         .then(res => this.user = res.data)
        //         .catch(err => console.log(err));
    },
}
</script>

<style scoped>
.unrealEmail {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 80%;
    color: #f66d9b;
}
</style>
