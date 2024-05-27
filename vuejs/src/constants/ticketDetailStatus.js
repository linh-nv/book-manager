export const TicketDetailStatus = {
  BORROWED: { id: 1, label: "Borrowed" },
  RETURNED: { id: 2, label: "Returned" },
  LOST: { id: 3, label: "Lost" },
  REJECTED: { id: 4, label: "Overdue" },
};

export const ticketDetailStatus = Object.values(TicketDetailStatus);

export function getStatusLabelById(id) {
  const status = ticketDetailStatus.find((status) => status.id === id);
  return status ? status.label : "Unknown Status";
}
