<template>
    <div class="section-body">
        <h2 class="section-title">Hi,{{ userData.name }}</h2>
        <p class="section-lead">Change information about yourself on this page.</p>
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        <img :alt="userData.name.slice(0,2).toUpperCase()" :src="'/storage/'+userData.avatar"
                             class="rounded-circle profile-widget-picture" style="height: 60px;width: 60px;">
                        <div class="profile-widget-items">
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Posts</div>
                                <div class="profile-widget-item-value">187</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Followers</div>
                                <div class="profile-widget-item-value">6,8K</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Following</div>
                                <div class="profile-widget-item-value">2,1K</div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-widget-description">
                        <div class="profile-widget-name">{{ userData.name }}
                            <div class="text-muted d-inline font-weight-normal">
                                <div class="slash"></div>
                                {{ userData.email }}
                            </div>
                        </div>
                        {{ userData.phone_number }}
                    </div>
                    <div class="card-footer text-center">
                        <div class="font-weight-bold mb-2">Follow {{ userData.name }} On</div>
                        <a href="#" class="btn btn-social-icon btn-facebook mr-1"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-social-icon btn-twitter mr-1"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="btn btn-social-icon btn-github mr-1"><i class="fab fa-github"></i></a>
                        <a href="#" class="btn btn-social-icon btn-instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <upload-user-image :userId="userData.id" @userAvatar="userData.avatar=$event" @userEditTo="userData=$event" ></upload-user-image>
                        <edit-profile-user :userEdit="user" @userEditTo="userData=$event"></edit-profile-user>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import editProfileUser from "./editProfileUser";

export default {
    name: "viewProfile",
    props: {
        'user': Object,
    },
    data() {
        return {
            userData: this.user,
        }
    },
    components: {
        editProfileUser,
    },
    mounted() {
    },
}
</script>
<style scoped>

</style>
