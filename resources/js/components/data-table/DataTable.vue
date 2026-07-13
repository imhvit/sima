<script setup lang="ts" generic="TData, TValue">
import { ref, watch, onBeforeUnmount } from 'vue';
import debounce from 'lodash/debounce';
import { router } from '@inertiajs/vue3';

import type { ColumnDef, VisibilityState } from '@tanstack/vue-table';
import { FlexRender, getCoreRowModel, useVueTable } from '@tanstack/vue-table';

import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import {
    DropdownMenu,
    DropdownMenuCheckboxItem,
    DropdownMenuContent,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { valueUpdater } from '@/components/ui/table/utils';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '../ui/select';
import { ChevronDown } from '@lucide/vue';
import { route } from 'ziggy-js';
import type { Pagination } from '@/types';

const props = withDefaults(
    defineProps<{
        columns: ColumnDef<TData, TValue>[];
        data: TData[];
        pagination: Pagination;
        searchPlaceholder?: string;
        columnLabels?: Record<string, string>;
        initialSearch?: string;
    }>(),
    {
        searchPlaceholder: 'Filtrar registros...',
        columnLabels: () => ({}),
    },
);

const columnVisibility = ref<VisibilityState>({});

const table = useVueTable({
    get data() {
        return props.data;
    },
    get columns() {
        return props.columns;
    },
    getRowId: (row: any) => row.id.toString(),
    getCoreRowModel: getCoreRowModel(),
    state: {
        get columnVisibility() {
            return columnVisibility.value;
        },
    },
    onColumnVisibilityChange: (updaterOrValue) =>
        valueUpdater(updaterOrValue, columnVisibility),
});

const searchQuery = ref(props.initialSearch ?? '');

function goTo(params: Record<string, any>) {
    const currentRoute = route().current();
    if (!currentRoute) return;

    router.get(
        route(currentRoute),
        {
            per_page: props.pagination.per_page,
            search: searchQuery.value,
            ...params,
        },
        { preserveState: true, preserveScroll: true, replace: true },
    );
}

const debouncedSearch = debounce((newValue: string) => {
    goTo({ search: newValue, page: 1 });
}, 300);

watch(searchQuery, debouncedSearch);

onBeforeUnmount(() => {
    debouncedSearch.cancel();
});

function goToPage(url: string | null) {
    if (!url) return;
    router.get(url, {}, { preserveState: true, preserveScroll: true });
}

function handlePageSizeChange(size: string) {
    goTo({ per_page: Number(size), page: 1 });
}
</script>

<template>
    <div class="space-y-4">
        <div class="flex items-center">
            <Input
                class="max-w-sm"
                v-model="searchQuery"
                :placeholder="searchPlaceholder"
            />

            <DropdownMenu>
                <DropdownMenuTrigger as-child>
                    <Button variant="outline" class="ml-auto">
                        Columnas
                        <ChevronDown class="ml-2 h-4 w-4" />
                    </Button>
                </DropdownMenuTrigger>
                <DropdownMenuContent align="end">
                    <DropdownMenuCheckboxItem
                        v-for="column in table
                            .getAllColumns()
                            .filter((column) => column.getCanHide())"
                        :key="column.id"
                        class="capitalize"
                        :model-value="column.getIsVisible()"
                        @update:model-value="
                            (value) => column.toggleVisibility(!!value)
                        "
                    >
                        {{
                            columnLabels[column.id] ??
                            column.id.replace(/_/g, ' ')
                        }}
                    </DropdownMenuCheckboxItem>
                </DropdownMenuContent>
            </DropdownMenu>
        </div>

        <div class="flex max-h-[calc(100vh-200px)] w-full flex-col">
            <div
                class="flex flex-2/3 flex-col overflow-hidden rounded-md border"
            >
                <Table>
                    <TableHeader
                        class="sticky top-0 z-10 bg-background shadow-md shadow-primary/5"
                    >
                        <TableRow
                            v-for="headerGroup in table.getHeaderGroups()"
                            :key="headerGroup.id"
                        >
                            <TableHead
                                v-for="header in headerGroup.headers"
                                :key="header.id"
                            >
                                <FlexRender
                                    v-if="!header.isPlaceholder"
                                    :render="header.column.columnDef.header"
                                    :props="header.getContext()"
                                />
                            </TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <template v-if="table.getRowModel().rows?.length">
                            <TableRow
                                v-for="row in table.getRowModel().rows"
                                :key="row.id"
                                :data-state="
                                    row.getIsSelected() ? 'selected' : undefined
                                "
                            >
                                <TableCell
                                    v-for="cell in row.getVisibleCells()"
                                    :key="cell.id"
                                >
                                    <FlexRender
                                        :render="cell.column.columnDef.cell"
                                        :props="cell.getContext()"
                                    />
                                </TableCell>
                            </TableRow>
                        </template>
                        <template v-else>
                            <TableRow>
                                <TableCell
                                    :colspan="
                                        table
                                            .getAllColumns()
                                            .filter((column) =>
                                                column.getIsVisible(),
                                            ).length
                                    "
                                    class="h-24 text-center"
                                >
                                    Sin resultados
                                </TableCell>
                            </TableRow>
                        </template>
                    </TableBody>
                </Table>
            </div>
        </div>

        <div class="flex items-center justify-between px-2 py-4">
            <div class="flex-1 text-sm text-muted-foreground">
                {{ pagination.total }} registro(s) en total
            </div>

            <div class="flex items-center space-x-6 lg:space-x-8">
                <div class="flex items-center space-x-2">
                    <p class="text-sm font-medium">Filas por página</p>
                    <Select
                        :model-value="`${pagination.per_page}`"
                        @update:model-value="
                            (value: any) => handlePageSizeChange(value)
                        "
                    >
                        <SelectTrigger class="h-8 w-[70px]">
                            <SelectValue
                                :placeholder="`${pagination.per_page}`"
                            />
                        </SelectTrigger>
                        <SelectContent side="top">
                            <SelectItem
                                v-for="size in [10, 20, 30, 40, 50]"
                                :key="size"
                                :value="`${size}`"
                            >
                                {{ size }}
                            </SelectItem>
                        </SelectContent>
                    </Select>
                </div>

                <div class="flex items-center space-x-2">
                    <div
                        class="flex items-center justify-center text-sm font-medium"
                    >
                        Página
                        {{ pagination.current_page }} de
                        {{ pagination.last_page }}
                    </div>
                    <div class="flex items-center space-x-2">
                        <Button
                            variant="outline"
                            :disabled="!pagination.prev_page_url"
                            @click="goToPage(pagination.prev_page_url)"
                        >
                            <span class="sr-only">Ir a la página anterior</span>
                            Anterior
                        </Button>
                        <Button
                            variant="outline"
                            :disabled="!pagination.next_page_url"
                            @click="goToPage(pagination.next_page_url)"
                        >
                            <span class="sr-only"
                                >Ir a la página siguiente</span
                            >
                            Siguiente
                        </Button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
