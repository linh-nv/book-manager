export const Gender = {
    MALE: { id: 1, label: "Male" },
    FEMALE: { id: 2, label: "Female" },
    OTHER: { id: 3, label: "Other" },
  };
  
  export const genderOptions = Object.values(Gender);
  
  export function getGenderLabelById(id) {
    const gender = genderOptions.find((gender) => gender.id === id);
    return gender ? gender.label : "Unknown Gender";
  }