<template>
    <!--<ais-instant-search-->
            <!--:search-client="searchClient"-->
            <!--index-name="products"-->
    <!--&gt;-->
        <!--&lt;!&ndash; Other search components go here &ndash;&gt;-->
    <!--</ais-instant-search>-->

    <ais-instant-search
            :search-client="searchClient"
            index-name="products"
    >
        <!--<ais-search-box placeholder="Search contacts..."></ais-search-box>-->


        <ais-search-box>
            <form slot-scope="{ currentRefinement, isSearchStalled, refine }" class="form-round py-30 col-lg-6" style="margin: 0 auto">
                <div class="input-group row">
                    <input  type="search"
                            v-model="currentRefinement"
                            @input="refine($event.currentTarget.value)" class="form-control form-control-lg" placeholder="Search for...">
                    <span :hidden="!isSearchStalled">Loading...</span>

                    <!--<span class="input-group-btn">-->
                     <!--<button class="btn btn-primary" type="button">Go!</button>-->
                </span>
                </div>
            </form>
        </ais-search-box>




        <ais-configure :hitsPerPage="9" />
        <ais-hits class="">
            <!--<div slot="item" slot-scope="{ item }">-->
                <!--<h2>{{ item.name }}</h2>-->
            <!--</div>-->

            <!--<div class="row gap-y">-->

                <template slot="item" slot-scope="{ item }" class="">

                    <div class="">

                        <div class="shop-item " >
                            <div class="item-details" style="height: 80px">
                                <div>
                                    <h5> <ais-highlight :hit="item" attribute="name"/></h5>
                                    <!--<h5>{{item.name | readMore(20, '...')}}</h5>-->
                                    <p>Category</p>
                                </div>

                                <div class="item-price"><span class="unit">N</span>{{item.price | formatMon}}</div>
                            </div>
                            <a :href="'product/' + item.slug">
                                <img src="assets/img/product-1.png" alt="product">
                            </a>

                            <add-to-cart :product_id = "item.id"></add-to-cart>

                        </div>

                    </div>

                </template>

            <!--</div>-->


        </ais-hits>
        <ais-pagination />
    </ais-instant-search>
</template>

<script>
    import algoliasearch from 'algoliasearch/lite';
    import 'instantsearch.css/themes/algolia-min.css';

    export default {
        data() {
            return {
                searchClient: algoliasearch(
                    process.env.MIX_ALGOLIA_APP_ID,
                    process.env.MIX_ALGOLIA_SEARCH
                ),
            };
        },
    };
</script>

<style scoped>
    /*.ais-Breadcrumb-list,.ais-CurrentRefinements-list,.ais-HierarchicalMenu-list,.ais-Hits-list,.ais-InfiniteHits-list,.ais-InfiniteResults-list,.ais-Menu-list,.ais-NumericMenu-list,.ais-Pagination-list,.ais-RatingMenu-list,.ais-RefinementList-list,.ais-Results-list,.ais-ToggleRefinement-list {*/
        /*margin: 0;*/
        /*padding: 0;*/
        /*list-style: none;*/
    /*}*/

    /*body {*/
        /*font-family: sans-serif;*/
        /*padding: 1em;*/
    /*}*/

    /*.ais-Hits-list {*/
        /*margin-top: 0;*/
        /*margin-bottom: 1em;*/
    /*}*/

    /*.ais-InstantSearch {*/
        /*display: grid;*/
        /*grid-template-columns: 1fr 4fr;*/
        /*grid-gap: 1em;*/
    /*}*/
</style>