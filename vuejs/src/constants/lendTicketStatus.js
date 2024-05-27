export const LendTicketStatus = {
  PENDING: { id: 1, label: "Pending" },
  APPROVED: { id: 2, label: "Approved" },
  REJECTED: { id: 3, label: "Rejected" },
};

export const lendTicketStatusList = Object.values(LendTicketStatus);

export function getStatusLabelById(id) {
  const status = lendTicketStatusList.find((status) => status.id === id);
  return status ? status.label : "Unknown Status";
}
