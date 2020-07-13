<template>
    <button :class="clase" @click="scrollTopCero">
        <i class="fas fa-arrow-circle-up fa-2x"></i>
    </button>
</template>

<script>

export default {
    data: function(){
        return({
            clase: 'hidden',
        })
    },
    methods: {
        scrollTopCero: function() {
            let scrollY    = window.scrollY;
            let scrollStep = -1 * (scrollY / 10);

            let scrollInterval = setInterval(function(){
                window.scrollY != 0 ? window.scrollBy( 0, scrollStep ) : clearInterval(scrollInterval); 
                scrollStep -= (scrollStep * 10 / 100);

                //console.log(window.scrollY, scrollStep);
            }, 20);
        },
    },
    mounted: function() {
        document.addEventListener('scroll', (e) => {
            let html = document.querySelector('html');

            if(document.scrollingElement.scrollTop > 300){
                this.clase = 'btn btn-scroll-top-cero'
            }
            else  {
                this.clase = 'hidden'
            }
        });
    },
}

</script>

<style scoped>

.btn-scroll-top-cero {
    position: fixed;
    right: 5px;
    bottom: 10px;

    background-color: #1a1d24; 
    color: #ffffff;

    transition: transform 0.5s ease-in-out;
}

.btn-scroll-top-cero:hover {
    transform: translateY(-20%);
}

</style>