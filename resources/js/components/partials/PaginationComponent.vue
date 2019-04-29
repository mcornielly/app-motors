<template>
    <div>
        <nav>
            <ul class="pagination">
                <li class="page-item" v-if="pagination.current_page > 1">
                    <a class="page-link" href="#" @click.prevent="nextPage(pagination.current_page - 1)">Ant</a>
                </li>
                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                    <a class="page-link" href="#" @click.prevent="nextPage(page)" v-text="page"></a>
                </li>
                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a class="page-link" href="#" @click.prevent="nextPage(pagination.current_page + 1)">Sig</a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    props:['pagination', 'offset'],
    computed: {
        isActived: function(){
            return this.pagination.current_page;
        },
        pagesNumber: function() {
            if(!this.pagination.to){
                return [];
            }

            var from = this.pagination.current_page - this.offset;   
            if(from < 1){
                from = 1;
            }

            var to = from + (this.offset * 2);
            if(to >= this.pagination.last_page){
                to =  this.pagination.last_page;          
            }

            var pagesArray = [];
            while(from <= to){
                pagesArray.push(from);
                from++;
            }

            return pagesArray;
        }
    },
    methods: {
        nextPage(page) {
            // console.log(page)
            // let me = this;
            if (page > this.pagination.last_page) {
                page = this.pagination.last_page;
            }
            this.pagination.current_page = page;
            this.$emit('paginate');
            // me.$emit(getClients(page));
            // me.getClients(page);    
        }
    }
}
</script>