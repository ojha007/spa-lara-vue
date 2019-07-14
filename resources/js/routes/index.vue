<script>
    import User from '../components/User';
    import Dashboard from '../components/Dashboard';
    import Product from "../components/Product";
    import Blog from "../components/Blog";
    import Brand from "../components/Brand";

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
        {
            path: '/brand',
            component: Brand
        },
    ];

    export default routes;

</script>
