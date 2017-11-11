package oe.ui.helper;

import javafx.beans.value.ChangeListener;
import javafx.beans.value.ObservableValue;
import javafx.scene.control.cell.CheckBoxTableCell;

public class ActionCheckBoxTableCell extends CheckBoxTableCell {
    public ActionCheckBoxTableCell() {
        this.setDisable(true);
        //todo: fix or remove
        this.selectedProperty().addListener(new ChangeListener<Boolean>() {
            public void changed(ObservableValue<? extends Boolean> ov,
                                Boolean old_val, Boolean new_val) {
                System.out.println("involved");
            }
        });
        this.setEditable(true);
    }
}
