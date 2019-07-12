<script>
    import User from '../components/User';
    import Dashboard from '../components/Dashboard';
    import Product from "../components/Product";
    import Blog from "../components/Blog";

    const routes = [
        {
            path: '/user',
            component: User
        },

        {
            path: '/dashboard',
            component: Dashboard
        },
        {
            path: '/product',
            component: Product
        },
        {
            path: '/blog',
            component: Blog
        },


    ];

    export default routes;

</script>
