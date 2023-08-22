<template>
    <div class="relative">
        <input
            v-model="searchText"
            @input="handleInput"
            @blur="handleBlur"
            @keydown.enter="handleEnter"
            @keydown.arrow-up.prevent="navigateOptions(-1)"
            @keydown.arrow-down.prevent="navigateOptions(1)"
            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full block p-2"
        />
        <ul v-show="dropdownOpen" class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg">
            <li
                v-for="(item, index) in filteredOptions"
                :key="item[itemValue]"
                @click="selectItem(item)"
                :class="['cursor-pointer p-2 hover:bg-indigo-100', { 'bg-indigo-600 text-white': selectedIndex === index }]"
            >
                {{ item[itemText] }}
            </li>
        </ul>
    </div>
</template>

<script setup>
import { computed, ref, watch, onMounted } from 'vue';

const props = defineProps({
    modelValue: {},
    items: Array,
    itemText: {
        type: String,
        default: 'name',
    },
    itemValue: {
        type: String,
        default: 'id',
    },
    withoutSelect: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(['update:modelValue']);
const searchText = ref('');
const dropdownOpen = ref(false);
const selectedIndex = ref(-1);

const options = computed(() => {
    if (props.withoutSelect) return props.items;

    return [
        { [props.itemText]: 'Select', [props.itemValue]: '' },
        ...props.items,
    ];
});

const filteredOptions = computed(() => {
    return options.value.filter((item) =>
        item[props.itemText].toLowerCase().includes(searchText.value.toLowerCase())
    );
});

const selectItem = (item) => {
    handleUpdateModelValue(item[props.itemValue]);
    closeDropdown();
};

const handleUpdateModelValue = (value) => {
    emit('update:modelValue', value);
    const selectedItem = options.value.find((item) => item[props.itemValue] === value);
    if (selectedItem) {
        searchText.value = selectedItem[props.itemText];
    } else {
        searchText.value = '';
    }
};

const handleInput = () => {
    openDropdown();
    selectedIndex.value = -1;
};

const handleBlur = () => {
    closeDropdown();
    selectedIndex.value = -1;
};

const handleEnter = () => {
    if (selectedIndex.value !== -1) {
        selectItem(filteredOptions.value[selectedIndex.value]);
    }
};

const openDropdown = () => {
    dropdownOpen.value = true;
};

const closeDropdown = () => {
    dropdownOpen.value = false;
};

const navigateOptions = (direction) => {
    if (filteredOptions.value.length === 0) return;

    selectedIndex.value = (selectedIndex.value + direction + filteredOptions.value.length) % filteredOptions.value.length;
};

// Watch for changes to the modelValue and update the searchText accordingly
watch(
    () => props.modelValue,
    (newValue) => {
        const selectedItem = options.value.find((item) => item[props.itemValue] === newValue);
        if (selectedItem) {
            searchText.value = selectedItem[props.itemText];
        } else {
            searchText.value = '';
        }
    }
);

// Initialize searchText based on the initial modelValue
onMounted(() => {
    const selectedItem = options.value.find((item) => item[props.itemValue] === props.modelValue);
    if (selectedItem) {
        searchText.value = selectedItem[props.itemText];
    }
});
</script>
