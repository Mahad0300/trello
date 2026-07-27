<!-- View 3: Flat Sortable List / Table View Container -->
<div id="list-view-container" class="view-container" style="display: none; padding: 24px;">
  <div class="card p-0" style="background: white; border-radius: var(--radius-md); box-shadow: var(--shadow-sm); overflow: hidden;">
    <div style="padding: 16px 20px; border-bottom: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between;">
      <h3 style="margin: 0; font-size: 16px; font-weight: 700;"><i class="fa-solid fa-list-check icon-primary"></i> Board Cards Table List</h3>
      <span class="badge badge-info font-weight-600">6 Cards Total</span>
    </div>
    <table class="data-table">
      <thead>
        <tr>
          <th>Card Title</th>
          <th>List Column</th>
          <th>Assignees</th>
          <th>Priority</th>
          <th>Checklist Progress</th>
          <th>Due Date</th>
          <th style="text-align: right;">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr onclick="window.openModal('card-detail-modal');" style="cursor: pointer;">
          <td style="font-weight: 600; color: var(--primary);">
            <i class="fa-solid fa-credit-card mr-6 text-muted-icon"></i> HTML5 Drag & Drop Card Physics
          </td>
          <td><span class="badge badge-warning">In Progress</span></td>
          <td>
            <div class="avatar-group" style="display: flex; gap: -4px;">
              <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&q=80" class="avatar avatar-sm" title="Sarah Connor">
            </div>
          </td>
          <td><span class="badge badge-danger">High</span></td>
          <td style="width: 140px;">
            <div style="display: flex; align-items: center; gap: 8px;">
              <div class="checklist-track" style="flex: 1;"><div class="checklist-fill-line" style="width: 50%;"></div></div>
              <span style="font-size: 11px; font-weight: 700; color: var(--primary);">50%</span>
            </div>
          </td>
          <td style="font-size: 12px; color: var(--text-muted);"><i class="fa-regular fa-clock mr-4"></i> Oct 28, 2026</td>
          <td style="text-align: right;"><button class="btn btn-secondary btn-sm">View Card</button></td>
        </tr>
        <tr onclick="window.openModal('card-detail-modal');" style="cursor: pointer;">
          <td style="font-weight: 600; color: var(--primary);">
            <i class="fa-solid fa-credit-card mr-6 text-muted-icon"></i> MySQL PDO Prepared Statements
          </td>
          <td><span class="badge badge-info">To-Do</span></td>
          <td>
            <div class="avatar-group">
              <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&q=80" class="avatar avatar-sm" title="Alex Turner">
            </div>
          </td>
          <td><span class="badge badge-warning">Medium</span></td>
          <td style="width: 140px;">
            <div style="display: flex; align-items: center; gap: 8px;">
              <div class="checklist-track" style="flex: 1;"><div class="checklist-fill-line" style="width: 25%;"></div></div>
              <span style="font-size: 11px; font-weight: 700; color: var(--primary);">25%</span>
            </div>
          </td>
          <td style="font-size: 12px; color: var(--text-muted);"><i class="fa-regular fa-clock mr-4"></i> Nov 02, 2026</td>
          <td style="text-align: right;"><button class="btn btn-secondary btn-sm">View Card</button></td>
        </tr>
        <tr onclick="window.openModal('card-detail-modal');" style="cursor: pointer;">
          <td style="font-weight: 600; color: var(--primary);">
            <i class="fa-solid fa-credit-card mr-6 text-muted-icon"></i> Color Palette & Typography Guidelines
          </td>
          <td><span class="badge badge-secondary">Review</span></td>
          <td>
            <div class="avatar-group">
              <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80" class="avatar avatar-sm" title="David Chen">
            </div>
          </td>
          <td><span class="badge badge-success">Low</span></td>
          <td style="width: 140px;">
            <div style="display: flex; align-items: center; gap: 8px;">
              <div class="checklist-track" style="flex: 1;"><div class="checklist-fill-line" style="width: 100%;"></div></div>
              <span style="font-size: 11px; font-weight: 700; color: var(--primary);">100%</span>
            </div>
          </td>
          <td style="font-size: 12px; color: var(--text-muted);"><i class="fa-regular fa-clock mr-4"></i> Oct 24, 2026</td>
          <td style="text-align: right;"><button class="btn btn-secondary btn-sm">View Card</button></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
