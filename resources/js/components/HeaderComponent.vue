<template>
    <div>
        <header>

            <!-- <nav class="navbar bg-primary" data-bs-theme="dark"> -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <a class="navbar-brand" href="#">Boolpress</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <!-- <li class="nav-item active"> -->
                        <li v-for=" (item, index) in menuItem" :key="item.index">
                            <router-link :to="{ name: item.routeName}" class="nav-link" >{{item.label}}</router-link>
                        </li>


                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>

                    <a class="ml-4 navbar-brand nav-bar-dark" href="/admin">Area Riservata</a>

                </div>
            </nav>

        </header>
    </div>
</template>

<script>
export default {
    name: "HeaderComponent",
    data(){
        return {

            menuItem: [
                {
                    label: 'Home',
                    routeName: 'home',
                },
                {
                    label: 'Posts',
                    routeName: 'posts',
                },
                {
                    label: 'Chi Siamo',
                    routeName: 'about',
                },
                {
                    label: 'Contatti',
                    routeName: 'contact',
                },

            ]
        }
    }
}
</script>

<style lang="scss">

</style>
