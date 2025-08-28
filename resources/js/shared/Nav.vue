<template>
    <nav>
        <ul class="flex space-x-6">
            <li>
                <NavLink href="/" :active="$page.url === '/'">
                    Home
                </NavLink>
            </li>
            <li>
                <NavLink :active="$page.url === '/users'" href="/users">
                    Users
                </NavLink>
            </li>
            <li>
                <NavLink :active="$page.url === '/settings'" href="/settings">
                    Settings
                </NavLink>
            </li>
            <li>
                <NavLink href="/logout" method="post">
                    Logout
                </NavLink>
            </li>
        </ul>
    </nav>
</template>

<script>
import NavLink from './NavLink.vue';

export default {
    name: 'Nav',
    components: { NavLink },
};
</script>
