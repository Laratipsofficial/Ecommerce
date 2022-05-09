<script setup>
import { computed, ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import Container from "@/Components/Container.vue";
import Card from "@/Components/Card/Card.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";

const props = defineProps({
    role: {
        type: Object,
        default: () => {
            permissions: [];
        },
    },
    permissions: {
        type: Array,
    },
});

const search = ref("");

const filteredPermissions = computed(() => {
    return props.permissions.filter((p) =>
        p.name.toLowerCase().includes(search.value.toLowerCase())
    );
});

const roleHasPermission = (permission) => {
    return props.role.permissions.some((p) => p.id == permission.id);
};

const attachPermission = (permission) => {
    Inertia.post(
        route("admin.roles.attach-permission"),
        {
            roleId: props.role.id,
            permissionId: permission.id,
        },
        {
            preserveScroll: true,
            preserveState: true,
        }
    );
};

const detachPermission = (permission) => {
    Inertia.post(
        route("admin.roles.detach-permission"),
        {
            roleId: props.role.id,
            permissionId: permission.id,
        },
        {
            preserveScroll: true,
            preserveState: true,
        }
    );
};
</script>

<template>
    <Container>
        <Card>
            <template #header>
                Permissions
            </template>

            <div class="w-1/4">
                <Input type="text"
                       class="mt-1 block w-full"
                       v-model="search"
                       placeholder="Search" />
            </div>

            <ul class="mt-4">
                <li v-for="(permission, index) in filteredPermissions"
                    :key="permission.id"
                    class="px-2 py-2 flex items-center justify-between hover:bg-gray-100"
                    :class="{
                        'border-b': index < (permissions.length - 1),
                    }">
                    <div :class="{'text-green-700 font-bold' : roleHasPermission(permission)}">{{ permission.name }}</div>
                    <Button v-if="roleHasPermission(permission)"
                            @click="detachPermission(permission)"
                            color="green">Detach</Button>
                    <Button v-else
                            @click="attachPermission(permission)">Attach</Button>
                </li>
            </ul>
        </Card>
    </Container>
</template>