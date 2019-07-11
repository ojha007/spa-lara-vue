<script>
    import User from '../components/User';
    import Dashboard from '../components/Dashboard';
    import Product from "../components/Product";
    import Blog from "../components/Blog";
    import Login from "../components/Login";
    import Register from "../components/Register";
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
            path: '/login',
            component: Login
        },
        {
            path: '/brand',
            component: Brand
        },
        {
            path: '/register',
            component: Register
        },


    ];

    export default routes;

</script>
