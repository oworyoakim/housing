import {Amenity} from "@/manager/store/amenity/types";

export class Image {
    id: number|null;
    name: string|null;
    path: string|null;
    thumbnailName: string|null;
    thumbnailPath: string|null;
    featured: boolean;

    constructor(image?: any) {
        this.id = image?.id || null;
        this.name = image?.name || '';
        this.path = image?.path || '';
        this.thumbnailName = image?.thumbnailName || '';
        this.thumbnailPath = image?.thumbnailPath || '';
        this.featured = image?.featured || false;
    }
}

export class Property {
    id: number|null;
    name:  string|null;
    description: string|null;
    userId: number|null;
    businessId: number|null
    featuredImage: Image|null;
    amenitiesForDisplay:  string[];
    numberOfRooms: number|null;
    country: string|null;
    city: string|null;
    street: string|null;
    zip: string|null;
    photo: File|null;
    published: boolean;
    amenities: Amenity[];

    constructor(property?: any) {
        this.id = property?.id || null;
        this.name = property?.name || '';
        this.description = property?.description || '';
        this.userId = property?.userId || null;
        this.businessId = property?.businessId || null;
        this.numberOfRooms = property?.numberOfRooms || null;
        this.country = property?.country || null;
        this.city = property?.city || '';
        this.street = property?.street || null;
        this.zip = property?.zip || null;
        this.published = property?.published || false;
        this.featuredImage = property?.featuredImage || null;
        this.amenitiesForDisplay = property?.amenitiesForDisplay || [];
        this.amenities = property?.amenities || [];
        this.photo = property?.photo || null;
    }
}

export class Room {
    id: number|null;
    name:  string|null;
    description:  string|null;
    propertyId: string|null;
    categoryId: string|null;
    frequency: number|null;
    bathrooms: number|null;
    rate: number|null;
    ratePeriod: string|null;
    tax: number|null;
    numberOfBeds: number;
    totalCapacity: number;
    featuredImage: Image|null;
    amenitiesForDisplay: string[];
    photo: File|null;
    published: boolean;
    amenities: [];

    constructor(room?: any) {
        this.id = room?.id || null;
        this.name = room?.name || '';
        this.description = room?.description || '';
        this.propertyId = room?.propertyId || null;
        this.categoryId = room?.categoryId || null;
        this.frequency = room?.frequency || null;
        this.bathrooms = room?.bathrooms || null;
        this.rate = room?.rate || null;
        this.ratePeriod = room?.ratePeriod || '';
        this.tax = room?.tax || null;
        this.numberOfBeds = room?.numberOfBeds || 0;
        this.totalCapacity = room?.totalCapacity || 0;
        this.published = room?.published || false;
        this.featuredImage = room?.featuredImage || null;
        this.amenitiesForDisplay = room?.amenitiesForDisplay || [];
        this.amenities = room?.amenities || [];
        this.photo = room?.photo || null;
    }


}
