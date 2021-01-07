<template>
    <div>
       <Navbar></Navbar>
       <div class="container-fluid">
         <Sidebar></Sidebar>
       </div>
    </div>
</template>

<script>

import Navbar from './Navbar';
import Sidebar from './Sidebar';

export default {
    components: {
        Navbar,
        Sidebar
    }
}
</script>




