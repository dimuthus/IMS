<template>

</template>

<script>
    export default {
        name: "Me",
        created() {
            //User.logout();
            this.profile();
            Toast.fire({
                icon: 'success',
                title: 'Logout successfully'

            });
            this.$router.push({name: 'me'})
        },
            methods: {
            profile() {
                axios.post('/api/auth/me','token='+user.token())
                    .then(res => {
                        User.responseAfterLogin(res);
                        Toast.fire({
                            icon: 'success',
                            title: 'Sign In Successfully!',
                        });
                        //this.$router.push({name: 'home'})
                    })
                    .catch(error => {
                        if(error.response.data.errors){
                            this.errors = error.response.data.errors
                        }else{
                            Toast.fire({
                                icon: 'error',
                                title: 'Email Or Password Invalid!',
                            });
                        }

                    });


            }
        }
    }
</script>

<style scoped>

</style>
