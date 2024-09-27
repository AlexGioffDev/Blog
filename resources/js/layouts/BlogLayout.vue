<template>
    <main>
        <slot />
    </main>

    <footer>
        <p>&copy; {{ new Date().getFullYear() }} Blog Title</p>
    </footer>
</template>
