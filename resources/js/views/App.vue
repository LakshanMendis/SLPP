<template>
    <router-view></router-view>
</template>
<script>
const config = {
    name: 'App',
    created() {
        const currentPath = this.$router.history.current.path;

        if (window.localStorage.getItem('authenticated') === 'false') {
        this.$router.push('/login');
        }

        if (currentPath === '/' || currentPath === '/app') {
        this.$router.push('/app/dashboard');
        }
    }
}

export default config;
</script>

<style src="../styles/theme.scss" lang="scss" />