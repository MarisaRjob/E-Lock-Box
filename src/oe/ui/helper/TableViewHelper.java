package oe.ui.helper;

import com.sun.prism.impl.Disposer;
import javafx.collections.ObservableList;
import javafx.scene.control.TableCell;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.cell.CheckBoxTableCell;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.util.Callback;
import oe.ui.sf.UiAction;
import oe.util.Tuple;

import javax.swing.*;
import java.util.Hashtable;

public class TableViewHelper {

    public static void initTableView(TableView tableView, ObservableList data, TableColumn[] tableColumns) {

        tableView.setItems(data);
        tableView.getColumns().addAll(tableColumns);
    }

    /**
     * Define columns for table view
     * @param columnSimpleDefinitions all column uses PropertyValueFactory for Cell Value Factory, except for column define in columnSpecialDefintion
     * @return all table column
     */

    public static TableColumn[] defineColumns(Tuple<String, String>[] columnSimpleDefinitions,
                                              Hashtable<Integer, Callback> cellDefinition,
                                              Hashtable<Integer,Callback> columnSpecialDefintion,
                                              Hashtable<Integer, Callback<TableColumn<Disposer.Record, Boolean>, TableCell<Disposer.Record, Boolean>>> cellfactoryDefinitions){
        if( columnSimpleDefinitions == null || columnSimpleDefinitions.length <= 0)
            return new TableColumn[0];
        TableColumn[] tableColumns = new TableColumn[columnSimpleDefinitions.length];
        for(int count=0; count < columnSimpleDefinitions.length; count++){
            tableColumns[count] = new TableColumn(columnSimpleDefinitions[count].x);
            tableColumns[count].setCellValueFactory(new PropertyValueFactory<UiAction, String>(columnSimpleDefinitions[count].y));

            if (cellDefinition != null && cellDefinition.containsKey(count) ) {
                tableColumns[count].setCellFactory(CheckBoxTableCell.forTableColumn(tableColumns[count]));
            }

            if(columnSpecialDefintion != null && columnSpecialDefintion.containsKey(count)){
                tableColumns[count].setCellValueFactory(columnSpecialDefintion.get(count));
                if (cellfactoryDefinitions != null && cellfactoryDefinitions.containsKey(count)) {
                    tableColumns[count].setCellFactory(cellfactoryDefinitions.get(count));
                }
            }
            else {
                tableColumns[count].setCellValueFactory(new PropertyValueFactory<Action, String>(columnSimpleDefinitions[count].y));
            }

        }

        return tableColumns;
    }

}
