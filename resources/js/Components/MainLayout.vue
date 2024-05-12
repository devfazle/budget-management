<script setup>
import Sidebar from '../Components/Sidebar.vue';
import HeaderTop from '../Components/HeaderTop.vue';
import FooterBottom from '../Components/FooterBottom.vue';
</script>

<template>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <Sidebar />
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <HeaderTop />
            <!--  Header End -->
            <div class="container-fluid">
                <!--  Row 1 -->
                
                <!-- Component shows here -->
                <router-view v-slot="{ Component, route }">
                    <div :key="route.name">
                        <Component :is="Component" />
                    </div>
                </router-view>

                <FooterBottom/>
            </div>
        </div>
    </div>
</template>