package oe.ui.helper;


import javafx.scene.control.Hyperlink;
import javafx.scene.control.TableCell;
import javafx.scene.control.TableColumn;
import javafx.util.Callback;
import oe.ui.sf.UiAction;

public class HyperlinkCell implements  Callback<TableColumn<Item, Hyperlink>, TableCell<Item, Hyperlink>> {

    @Override
    public TableCell<Item, Hyperlink> call(TableColumn<Item, Hyperlink> arg) {
        TableCell<Item, Hyperlink> cell = new TableCell<Item, Hyperlink>() {
            @Override
            protected void updateItem(Hyperlink item, boolean empty) {
                setGraphic(item);
            }
        };
        return cell;
    }
}

