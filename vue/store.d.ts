import {API} from "./plugins/api";

declare module 'pinia' {
    export interface PiniaCustomProperties {
        api: API
    }
}

declare module 'vue' {
    interface ComponentCustomProperties {
        $api: API;
        $t: (s: string, options?: any) => string;
        $phone: (s: string) => string;
        $date: (s: string) => string;

        $timeDistance: (s: string|Date|number) => string
    }
}

declare module "@vue/runtime-core" {
    interface ComponentCustomProperties {
        $api: API;
        $t: (s: string, options?: any) => string;
        $phone: (s: string) => string;
        $date: (s: string) => string;

        $timeDistance: (s: string|Date|number) => string
    }
}
