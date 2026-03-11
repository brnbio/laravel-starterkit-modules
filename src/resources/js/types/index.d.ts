import { User } from "@/types/models";
import { RouteDefinition } from "@/wayfinder";

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export type BreadcrumbItemType = BreadcrumbItem;

export interface NavItem {
    title: string;
    href: RouteDefinition;
    icon?: string;
    isActive?: boolean;
    identifier?: string;
}

export type AppPageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    user: User;
    sidebarOpen: boolean;
};

export interface Option {
    id: number | string;
    text: string;
}

export interface BackedEnum {
    value: number | string;
    name: string;
    text: string;
}

export interface Paginator<T = any> {
    current_page: number;
    data: T[];
    first_page_url: string;
    from: number;
    last_page: number;
    last_page_url: string;
    links: {
        url: string | null;
        label: string;
        active: boolean;
    }[];
    next_page_url: string | null;
    path: string;
    per_page: number;
    prev_page_url: string | null;
    to: number;
    total: number;
}