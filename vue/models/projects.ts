export interface Projects {
    attributes: Attributes;
    id?: number;
    links?: Link;
    type: string;
}

export interface Skills {
    name: string | null;
}
export interface Link {
    name?: string | undefined;
    self?: {
        api: string | undefined;
        web: string | undefined;
    },
    comments?: string | undefined;
    bids?: string | undefined;
}
export interface Attributes {
    name?: string | undefined;
    budget?: {[key: string]: string};
    status?: Skills;
    skills?: Skills[];
    description?: string | undefined;
    description_html?: string | undefined;
    tags?: number[];
    updates?: number[];
    published_at?: number | undefined;
    expired_at?: string | undefined;
}

export interface Project {
    attributes: Attributes;
    links: Link;
}

export interface Data {
    data: Project;
    links?: {
        self: string | undefined;
        next: string | undefined;
        last: string | undefined;
    }
}


