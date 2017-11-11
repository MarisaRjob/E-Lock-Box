package oe.ui.helper;

import javafx.scene.control.Tab;
import javafx.scene.control.TableCell;

/**
 * For storing extra info for button and checkbox
 */
public class TableCellInfo extends TableCell {
    /**
     * when true, need special handling by calling CheckBoxTableCell.forTableColumn(column)
     */
    private boolean isChecbox;
    private TableCell tableCell;

    TableCellInfo(TableCell tc, boolean checbox) {
        tableCell = tc;
        isChecbox = checbox;
    }

    public boolean isChecbox() {
        return isChecbox;
    }
}
